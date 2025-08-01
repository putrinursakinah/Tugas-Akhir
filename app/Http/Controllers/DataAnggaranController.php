<?php

namespace App\Http\Controllers;

use App\Http\Controllers\DataAnggaranRepository;
use App\Http\Controllers\PrintGenerator;
use Illuminate\Http\Request;
use App\Models\DataAnggaran;
use App\Models\KodeAkun;
use App\Models\KodeKegiatan;
use App\Exports\DataAnggaranExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\DataAnggaranHierarchyService;
use App\Http\Requests\DataAnggaranRequest;
use App\Http\Requests\UpdateDataAnggaranRequest;
use App\Http\Requests\StoreDetailAkunRequest;
use App\Http\Controllers\DetailStoreDataAnggaran;
use App\Http\Requests\StoreAkunSementaraRequest;
use App\Http\Controllers\AkunSementaraSimpan;
use App\Http\Requests\SimpanAkunSementaraRequest;
use App\Http\Requests\SimpanKomponenSementaraRequest;

class DataAnggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->role !== 'bendahara' && auth()->user()->role !== 'kepala sekolah') {
            abort(403, 'Unauthorized');
        }
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

    public function komponenSimpan(SimpanKomponenSementaraRequest $request)
    {
        $selectedKegiatan = session('selectedKegiatan');

        KomponenSementaraSimpan::simpan($request->validated(), $selectedKegiatan);

        return redirect()->route('rkas.view')->with('success', 'Komponen berhasil ditambahkan!');
    }

    public function akunStore(StoreAkunSementaraRequest $request, $komponen_id)
    {
        $komponens = session('komponen_sementara', []);
        $komponen = collect($komponens)->firstWhere('id', $komponen_id);

        if (!$komponen) {
            return redirect()->route('rkas.view')->with('error', 'Komponen tidak ditemukan.');
        }

        AkunSementaraStore::store($request->akun_ids, $komponen_id);

        return redirect()->route('rkas.view')->with('success', 'Akun berhasil ditambahkan ke komponen.');
    }

    public function akunSimpan(SimpanAkunSementaraRequest $request, $komponen_id)
    {
        AkunSementaraSimpan::simpan(
            $request->kode_akun_id_akun,
            $komponen_id
        );
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
        $data = DetailTambahSessionService::getDetailTambahSession($akun_id);

        if (!$data || !$data['akun']) {
            return redirect()->route('rkas.view')->with('error', 'Akun tidak ditemukan.');
        }
        return view('backend.rkas.detail_rkas', $data);
    }

    public function detailStore(StoreDetailAkunRequest $request, $akun_id)
    {
        // Panggil class baru untuk tangani penyimpanan detail
        DetailStoreDataAnggaran::detailStore($request->validated(), $akun_id);
        // Redirect ke halaman view dengan pesan sukses
        return redirect()->route('rkas.view')->with('success', 'Detail akun berhasil ditambahkan');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($kategori_id)
    {
        $data = DataAnggaranRepository::getFormData($kategori_id);
        return view('backend.rkas.add_rkas', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DataAnggaranRequest $request)
    {
        DataAnggaranRepository::simpanDataAnggaran($request);
        return redirect()->route('rkas.view')->with('success', 'Data anggaran berhasil disimpan');
    }

    public function cetak($type)
    {

        $printer = PrintGenerator::selectPrinter($type);
        return $printer->print();
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
        $hierarchy = DataAnggaranHierarchyService::getHierarchy('$id');
        return view('backend.rkas.edit_rkas', $hierarchy);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDataAnggaranRequest $request, string $id)
    {
        $detail = UpdateDataAnggaranService::update($request, $id);
        DataAnggaranHierarchyService::updateJumlahParent($detail);
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
