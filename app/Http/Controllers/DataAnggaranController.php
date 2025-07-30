<?php

namespace App\Http\Controllers;

use App\Http\Controllers\DataAnggaranRepository;
use Illuminate\Http\Request;
use App\Models\DataAnggaran;
use App\Models\KodeAkun;
use App\Models\KodeKegiatan;
use App\Exports\DataAnggaranExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Komponen;
use App\Models\Kategori;
use App\Http\Requests\DataAnggaranRequest;
use App\Http\Requests\KomponenSimpanRequest;

class DataAnggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $dataDashboard = DataAnggaranRepository::getDashboardData();
        return view('backend.rkas.view_rkas', $dataDashboard);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function komponenForm()
    {
        if (!session()->has('selected_kegiatan_id')) {
            return redirect()->route('rkas.view')->with('error', 'Silakan pilih kegiatan terlebih dahulu.');
        }
        $kegiatan = KodeKegiatan::with('kategori')->find(session('selected_kegiatan_id'));
        $kategori = $kegiatan->kategori;

        return view('backend.rkas.komponen_rkas', compact('kegiatan', 'kategori'));
    }

    public function komponenSimpan(Request $request)
    {
        $request->validate([
            'kode' => 'required',
            'uraian' => 'required',
            'kegiatan_id' => 'required|exists:kode_kegiatan,id_kegiatan',
        ]);

        $selectedKegiatan = session('selectedKegiatan');

        $komponens = session()->get('komponen_sementara', []);

        $komponens[] = [
            'id' => uniqid(),
            'kode' => $request->kode,
            'uraian' => $request->uraian,
            'kegiatan_id' => $request->kegiatan_id,
            'kegiatan_kode' => $selectedKegiatan ? $selectedKegiatan->kode : '',
            'kegiatan_nama' => $selectedKegiatan ? $selectedKegiatan->kegiatan : '',
        ];
        session()->put('komponen_sementara', $komponens);

        return redirect()->route('rkas.view')->with('success', 'Komponen berhasil ditambahkan!');
    }

    public function akunStore(Request $request, $komponen_id)
    {
        $request->validate([
            'akun_ids' => 'required|array',
        ]);

        $komponens = session('komponen_sementara', []);
        $komponen = collect($komponens)->firstWhere('id', $komponen_id);

        if (!$komponen) {
            return redirect()->route('rkas.view')->with('error', 'Komponen tidak ditemukan.');
        }

        $akun_sementara = session()->get('akun_sementara', []);
        foreach ($request->akun_ids as $akun_id) {
            $akun = KodeAkun::where('id_akun', $akun_id)->first();
            if ($akun) {
                $akun_sementara[] = [
                    'id' => uniqid(),
                    'kode' => $akun->kode,
                    'uraian' => $akun->kegiatan,
                    'komponen_id' => $komponen_id,
                ];
            }
        }
        session()->put('akun_sementara', $akun_sementara);

        return redirect()->route('rkas.view')->with('success', 'Akun berhasil ditambahkan ke komponen.');
    }

    public function akunSimpan(Request $request, $komponen_id)
    {
        $request->validate([
            'kode_akun_id_akun' => 'required|exists:kode_akun,id_akun',
            'komponen_id' => 'required',
        ]);

        $akun = KodeAkun::find($request->kode_akun_id_akun);

        $akun_sementara = session()->get('akun_sementara', []);
        $akun_sementara[] = [
            'id' => uniqid(),
            'kode' => $akun->kode,
            'uraian' => $akun->uraian,
            'komponen_id' => $komponen_id,
        ];
        session()->put('akun_sementara', $akun_sementara);

        return redirect()->route('rkas.view')->with('success', 'Akun berhasil ditambahkan ke komponen');
    }

    public function akunTambah($komponen_id)
    {
        $kode_akun = KodeAkun::all(); // Kirim semua data akun ke form

        return view('backend.rkas.akun_rkas', [
            'komponen_id' => $komponen_id,
            'kode_akun' => $kode_akun,
        ]);
    }


    public function detailTambah($akun_id)
    {
        $akun = collect(session('akun_sementara', []))->firstWhere('id', $akun_id);

        if (!$akun) {
            return redirect()->route('rkas.view')->with('error', 'Akun tidak ditemukan.');
        }

        // Ambil komponen dari session
        $komponen = collect(session('komponen_sementara', []))->firstWhere('id', $akun['komponen_id']);
        $kegiatan = null;
        $kategori = null;
        if ($komponen) {
            $kegiatan = KodeKegiatan::find($komponen['kegiatan_id']);
            $kategori = $kegiatan ? $kegiatan->kategori : null;
        }

        return view('backend.rkas.detail_rkas', compact('akun', 'komponen', 'kegiatan', 'kategori'));
    }

    public function detailStore(Request $request, $akun_id)
    {

        $request->validate([
            'kode_detail' => 'required',
            'kode_urut' => 'required|numeric',
            'uraian_detail' => 'required|string',
            'vol' => 'nullable|numeric',
            'satuan' => 'nullable|string',
            'harga_satuan' => 'nullable|numeric',
            'jumlah' => 'nullable|numeric',
        ]);


        $kode_detail_full = $request->kode_detail . '.' . $request->kode_urut;

        // Simpan data detail
        $detail = DataAnggaran::create([
            'parent_id' => $akun_id,
            'kode_akun' => $kode_detail_full,
            'uraian' => $request->uraian_detail,
            'vol' => $request->vol,
            'satuan' => $request->satuan,
            'harga_satuan' => $request->harga_satuan,
            'jumlah' => $request->jumlah,
        ]);

        // Update total jumlah di parent
        $detail->updateParentTotals();

        // Redirect ke halaman view dengan pesan sukses
        return redirect()->route('rkas.view')->with('success', 'Detail akun berhasil ditambahkan');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($kategori_id)
    {
        $kategori = Kategori::findOrFail($kategori_id);
        $kegiatan = KodeKegiatan::where('kategori_id_kategori', $kategori_id)->get();
        $kodeAkun = KodeAkun::all();

        return view('backend.rkas.add_rkas', compact('kategori', 'kegiatan', 'kodeAkun', 'kategori_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DataAnggaranRequest $request)
    {
        $kodeKegiatan = KodeKegiatan::find($request->kegiatan_id);

        $komponen = Komponen::create([
            'kode' => $request->komponen_kode,
            'uraian' => $request->komponen_uraian,
            'kode_kegiatan_id_kegiatan' => $request->kegiatan_id,
            'kode_akun_id_akun' => $request->akun_id,
        ]);

        $akun = KodeAkun::find($request->akun_id);


        $detail = DataAnggaran::create([

            'uraian' => $request->detail_uraian,
            'vol' => $request->detail_vol,
            'satuan' => $request->detail_satuan,
            'harga_satuan' => $request->detail_harga_satuan,
            'jumlah' => $request->detail_jumlah,
            'kode_kegiatan_id_kegiatan' => $request->kegiatan_id,
            'komponen_id_komponen' => $komponen->id_komponen,
        ]);


        // return redirect()->route('rkas.view')->with('success', 'Data berhasil disimpan');
    }
    public function cetak()
    {
        $dataAnggaran = DataAnggaran::with([
            'komponen',
            'kegiatan',
            'parent',
        ])->get();

        $total = $dataAnggaran->sum('jumlah');

        return view('backend.rkas.cetak_rkas', compact('dataAnggaran', 'total'));
    }

    private function calculateSurplus($pendapatan, $belanja)
    {
        $totalPendapatan = $pendapatan->sum('jumlah');
        $totalBelanja = $belanja->sum('jumlah');
        return $totalPendapatan - $totalBelanja; // Hitung surplus
    }

    public function downloadExcel()
    {
        return Excel::download(new DataAnggaranExport, 'rkas.xlsx');
    }

    public function lock()
    {
        // Kunci semua data anggaran (bisa dibatasi per tahun/instansi jika perlu)
        DataAnggaran::query()->update(['is_locked' => 1]);

        return redirect()->route('rkas.view')->with('success', 'Data RKAS telah dikunci dan tidak dapat diedit lagi.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $detail = DataAnggaran::findOrFail($id);

        // Ambil data terkait
        $akun = $detail->parent; // Mengambil akun yang menjadi parent dari detail ini
        $komponen = $akun->parent; // Mengambil komponen dari akun
        $kegiatan = $komponen->parent; // Mengambil kegiatan dari komponen
        $kategori = $kegiatan->parent; // Mengambil kategori dari kegiatan

        return view('backend.rkas.edit_rkas', compact('detail', 'kategori', 'kegiatan', 'komponen', 'akun'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'uraian_detail' => 'required|string|max:255',
            'vol' => 'required|numeric',
            'satuan' => 'nullable|string',
            'harga_satuan' => 'required|numeric',
            'jumlah' => 'required|numeric',
        ]);

        // Temukan detail yang akan diperbarui
        $detail = DataAnggaran::findOrFail($id);

        // Update detail
        $detail->update([
            'uraian' => $request->uraian_detail,
            'vol' => $request->vol,
            'satuan' => $request->satuan,
            'harga_satuan' => $request->harga_satuan,
            'jumlah' => $request->jumlah,
        ]);

        // Update total di parent (akun)
        $parent = $detail->parent;
        if ($parent) {
            // Hitung total baru untuk akun
            $parent->jumlah = $parent->children->sum('jumlah');
            $parent->save();

            // Update total di komponen
            $komponen = $parent->parent;
            if ($komponen) {
                $komponen->jumlah = $komponen->children->sum('jumlah');
                $komponen->save();

                // Update total di kegiatan
                $kegiatan = $komponen->parent;
                if ($kegiatan) {
                    $kegiatan->jumlah = $kegiatan->children->sum('jumlah');
                    $kegiatan->save();
                }
            }
        }
        return redirect()->route('rkas.view', ['kategori_id' => $request->kategori_id])->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rkas = DataAnggaran::findOrFail($id);
        $rkas->delete();
        return redirect()->route('rkas.view', ['kategori_id' => $rkas->kategori_id])->with('success', 'Data berhasil dihapus');
    }
}
