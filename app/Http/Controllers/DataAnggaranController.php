<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataAnggaran;
use App\Models\KodeAkun;
use App\Models\KodeKegiatan;
use App\Exports\DataAnggaranExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Komponen;

class DataAnggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $pendapatan = DataAnggaran::where('jenis', 'pendapatan')->whereNull('parent_id')->get();
        $belanja = DataAnggaran::where('jenis', 'belanja')->whereNull('parent_id')->get();

        // Hitung summary
        $pendapatan_jumlah = $pendapatan->sum('jumlah');
        $belanja_jumlah = $belanja->sum('jumlah');

        return view('backend.rkas.view_rkas');
    }

    public function komponenView($id)
    {
        $rkas = DataAnggaran::with('kegiatan')->findOrFail($id);
        return view('rkas.komponen_rkas', compact('rkas'));
    }

    public function komponenStore(Request $request, $id)
    {
        $request->validate([
            'kode' => 'required|max:3',
            'uraian' => 'required',
        ]);

        Komponen::create([
            'kode' => $request->kode,
            'uraian' => $request->uraian,
            'data_anggaran_id' => $id,
        ]);

        return redirect()->route('rkas.view')->with('success', 'Komponen berhasil ditambahkan!');
    }

    public function akunTambah($komponen_id)
    {
        $komponen = DataAnggaran::findOrFail($komponen_id);
        $kegiatan = $komponen->parent; // relasi parent di model Rkas
        $kategori = $kegiatan->jenis ?? '';
        $daftar_akun = KodeAkun::where('kategori', $kategori)->get();
        $kegiatan_kode = $kegiatan->kode_akun ?? '';
        $kegiatan_nama = $kegiatan->uraian ?? '';
        $komponen_kode = $komponen->kode_akun ?? '';
        $komponen_nama = $komponen->uraian ?? '';
        $daftar_akun = KodeAkun::all();

        return view('backend.rkas.akun_rkas', compact(
            'kategori',
            'kegiatan_kode',
            'kegiatan_nama',
            'komponen_kode',
            'komponen_nama',
            'komponen_id',
            'daftar_akun'
        ));
    }

    public function akunStore(Request $request, $komponen_id)
    {
        $request->validate([
            'akun_ids' => 'required|array',
            'akun_ids.*' => 'exists:akun,id',
        ]);

        $komponen = DataAnggaran::findOrFail($komponen_id);

        foreach ($request->akun_ids as $akun_id) {
            $akun = KodeAkun::findOrFail($akun_id);

            DataAnggaran::create([
                'parent_id'    => $komponen->id,
                'kode_akun'    => $akun->kode,
                'uraian'       => $akun->uraian ?? $akun->kegiatan,
                'jenis'        => $komponen->jenis,
                'vol'          => null,
                'satuan'       => null,
                'harga_satuan' => null,
                'jumlah'       => null,
            ]);
        }

        return redirect()->route('rkas.view')->with('success', 'Akun berhasil ditambahkan ke komponen');
    }

    public function detailTambah($akun_id)
    {
        $akun = DataAnggaran::findOrFail($akun_id);

        // parent 
        $komponen = $akun->parent;
        $kegiatan = $komponen ? $komponen->parent : null;
        $kategori = $kegiatan ? $kegiatan->parent : null;

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
    public function create()
    {
        $kegiatan = KodeKegiatan::all(); // Ambil semua data kegiatan
        return view('backend.rkas.add_rkas', compact('kegiatan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'kegiatan_id' => 'required|exists:kode_kegiatan,id_kegiatan',
        ]);
        $kegiatan = KodeKegiatan::findOrFail($request->kegiatan_id);

        DataAnggaran::create([
            'kode' => $kegiatan->kode,
            'uraian' => $kegiatan->kegiatan,
            'jenis' => strtolower($kegiatan->kategori),
            'vol' => null,
            'satuan' => null,
            'harga_satuan' => null,
            'jumlah' => null,
        ]);

        return redirect()->route('rkas.view')->with('success', 'Kegiatan berhasil ditambahkan!');
    }

    public function cetak()
    {
        $pendapatan = DataAnggaran::where('kategori', 'pendapatan')->get(); // Ambil data pendapatan
        $belanja = DataAnggaran::where('kategori', 'belanja')->get(); // Ambil data belanja
        $surplus = $this->calculateSurplus($pendapatan, $belanja); // Fungsi untuk menghitung surplus

        return view('backend.rkas.cetak_rkas', compact('pendapatan', 'belanja', 'surplus'));
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
        return redirect()->route('rkas.view')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rkas = DataAnggaran::findOrFail($id);
        $rkas->delete();
        return redirect()->route('rkas.view')->with('success', 'Data berhasil dihapus');
    }
}
