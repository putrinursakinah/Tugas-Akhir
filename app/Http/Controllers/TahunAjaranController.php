<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TahunAjaran;
use App\Models\TahunAjaranKodeKegiatan;

class TahunAjaranController extends Controller
{
    public function index() 
    {
        $data = TahunAjaran::all();
        return view('backend.tahun.view_tahun', compact('data'));
    }

    public function store(Request $request)
    {
        TahunAjaran::create([
            'tahun' => $request->tahun,
        ]);
        return redirect()->back()->with('success', 'Tahun ajaran ditambahkan.');
    }

    public function setAktif($id)
    {
        // Nonaktifkan semua tahun
        TahunAjaran::query()->update(['is_active' => false]);

        // Aktifkan tahun terpilih
        $tahunAktif = TahunAjaran::findOrFail($id);
        $tahunAktif->update(['is_active' => true]);

        // Nonaktifkan semua di tabel kode kegiatan
        TahunAjaranKodeKegiatan::query()->update(['is_active' => false]);

        // Cek apakah data tahun sudah ada di tabel kode kegiatan
        $kodeKegiatan = TahunAjaranKodeKegiatan::where('tahun', $tahunAktif->tahun)->first();

        if ($kodeKegiatan) {
            // Jika ada, update is_active = true
            $kodeKegiatan->update(['is_active' => true]);
        } else {
            // Jika tidak ada, buat baru
            TahunAjaranKodeKegiatan::create([
                'tahun' => $tahunAktif->tahun,
                'is_active' => true
            ]);
        }

        // Simpan ke session
        session(['tahun_aktif' => $tahunAktif->tahun]);

        return redirect()->back()->with('success', 'Tahun ajaran diaktifkan.');
    }
}
