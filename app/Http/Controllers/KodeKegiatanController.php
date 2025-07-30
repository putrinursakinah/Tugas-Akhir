<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KodeKegiatan; // pastikan model KodeKegiatan sudah dibuat
use App\Models\Kategori; // pastikan model Kategori sudah dibuat
use App\Models\TahunAjaranKodeKegiatan; // pastikan model TahunAjaranKodeKegiatan sudah dibuat

class KodeKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kegiatan = KodeKegiatan::all();
        return view('backend.kegiatan.view_kegiatan', compact('kegiatan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $kategoriList = Kategori::all();
        return view('backend.kegiatan.add_kegiatan', compact('kategoriList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|digits:4|unique:kode_kegiatan,kode',
            'kegiatan' => 'required|string|max:255',
            'kategori_id_kategori' => 'required|exists:kategori,id_kategori',
        ]);

        $kategori = Kategori::find($request->kategori_id_kategori);
        $kode = (int) $request->kode;

        // Validasi berdasarkan kategori
        if ($kategori->nama_kategori === 'Pendapatan' && !($kode >= 1000 && $kode <= 1999)) {
            return redirect()->back()->withInput()->withErrors(['kode' => 'Kode untuk kategori Pendapatan harus antara 1000–1999.']);
        }

        if ($kategori->nama_kategori === 'Belanja' && !($kode >= 2000 && $kode <= 2999)) {
            return redirect()->back()->withInput()->withErrors(['kode' => 'Kode untuk kategori Belanja harus antara 2000–2999.']);
        }
        $tahun = session('tahun_ajaran', date('Y')); // ambil tahun ajaran dari session atau gunakan tahun saat ini

        $tahunAjaran = TahunAjaranKodeKegiatan::firstOrCreate(['tahun' => $tahun]);

        KodeKegiatan::create([
            'kode' => $request->kode,
            'kegiatan' => $request->kegiatan,
            'kategori_id_kategori' => $request->kategori_id_kategori,
            'kategori_kegiatan' => Kategori::find($request->kategori_id_kategori)->nama_kategori,
            'id_tahun_ajaran_kode_kegiatan' => $tahunAjaran->id_tahun_ajaran_kode_kegiatan,
        ]);

        return redirect()->route('kegiatan.view')->with('success', 'Kegiatan berhasil ditambahkan!');
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
        $kegiatan = KodeKegiatan::findOrFail($id);
        return view('backend.kegiatan.edit_kegiatan', compact('kegiatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'kode' => 'required|digits:4|unique:kode_kegiatan,kode,' . $id . ',id_kegiatan',
            'kegiatan' => 'required|string|max:255',
            'kategori' => 'required|string|max:255', // pastikan kolom kategori ada di tabel kegiatan
        ]);

        $kegiatan = KodeKegiatan::findOrFail($id);
        $kegiatan->update([
            'kode' => $request->kode,
            'kegiatan' => $request->kegiatan,
            'kategori' => $request->kategori, // pastikan kolom kategori ada di tabel kegiatan
        ]);
        return redirect()->route('kegiatan.view')->with('success', 'Kegiatan berhasil diperbarui!');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;
        if ($ids && count($ids)) {
            KodeKegiatan::whereIn('id_kegiatan', $ids)->delete();
            return redirect()->route('kegiatan.view')->with('success', 'Data terpilih berhasil dihapus!');
        }
        return redirect()->route('kegiatan.view')->with('error', 'Tidak ada data yang dipilih untuk dihapus!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $ids = $request->ids;
        if ($ids && count($ids)) {
            KodeKegiatan::whereIn('id_kegiatan', $ids)->delete();
            return redirect()->route('kegiatan.view')->with('success', 'Data terpilih berhasil dihapus!');
        }

        return redirect()->route('kegiatan.view')->with('success', 'Kegiatan berhasil dihapus!');
    }
}
