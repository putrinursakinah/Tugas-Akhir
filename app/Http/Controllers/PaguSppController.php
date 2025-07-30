<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataAnggaran;
use App\Models\PaguSpp;
use App\Models\TahunAjaranKodeKegiatan;

class PaguSppController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tahunAjaranAktif = TahunAjaranKodeKegiatan::where('is_active', 1)->first();

        if (!$tahunAjaranAktif) {
            return redirect()->back()->with('error', 'Tahun ajaran aktif belum diatur.');
        }
        $dataAnggaran = DataAnggaran::whereHas('komponen.kodekegiatan', function ($q) {
            $q->where('kategori_id_kategori', 1); // 1 = pendapatan
        })->get();

        // Ambil semua data yang sudah dimapping ke pagu_spp
        $paguSpp = PaguSpp::with('anggaran')->get();

         return view('backend.pagu.view_pagu', compact('dataAnggaran', 'paguSpp'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_anggaran' => 'required|exists:data_anggaran,id_anggaran',
        ]);

        $tahunAjaranAktif = TahunAjaranKodeKegiatan::where('is_active', 1)->first();

        PaguSpp::create([
            'id_anggaran' => $request->id_anggaran,
            'id_tahun_ajaran_kode_kegiatan' => $tahunAjaranAktif->id_tahun_ajaran_kode_kegiatan,
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan ke mapping SPP');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
