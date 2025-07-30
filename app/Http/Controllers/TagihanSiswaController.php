<?php

namespace App\Http\Controllers;

use App\Models\TagihanSiswa;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\JenisBiaya;
use App\Models\Kelas;
use App\Models\KelasHasSiswa;

class TagihanSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tagihan = TagihanSiswa::with('kelasHasSiswa.siswa', 'kelasHasSiswa.kelas', 'jenisBiaya')->get();

        return view('backend.tagihan.view_tagihan', compact('tagihan'));
    }

    public function generatePage(Request $request)
    {
        $jenisBiayaList = JenisBiaya::all();

        // Ambil daftar kelas unik dari tabel kelas
        $kelasList = Kelas::pluck('nama', 'id_kelas');

        // Ambil semua data kelas_has_siswa dan eager load relasi siswa dan kelas
        $siswaList = [];

        if ($request->filled('kelas')) {
            $siswaList = KelasHasSiswa::with(['siswa', 'kelas'])
                ->where('kelas_id_kelas', $request->kelas)
                ->get();
        }

        return view('backend.tagihan.generate_tagihan', compact('kelasList', 'jenisBiayaList', 'siswaList'));
    }

    public function generate(Request $request)
    {
        $request->validate([
            'jenis_biaya' => 'required|exists:jenis_biaya,id_jenisbiaya',
            'siswa_ids' => 'required|array',
        ]);

        foreach ($request->siswa_ids as $id_kelashassiswa) {
            TagihanSiswa::create([
                'tgl_tagihan' => now(),
                'status' => 'Belum Lunas',
                'jenis_biaya_id_jenisbiaya' => $request->jenis_biaya,
                'kelas_has_siswa_id_kelashassiswa' => $id_kelashassiswa,
            ]);
        }


        return redirect()->route('tagihan.view')->with('success', 'Tagihan berhasil digenerate.');
    }


    public function getSiswaByKelas($kelas_id)
    {
        $siswaList = KelasHasSiswa::with(['siswa', 'kelas'])
            ->where('kelas_id_kelas', $kelas_id)
            ->get();

        return response()->json($siswaList);
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
            'jenis_biaya' => 'required|exists:jenis_biaya,id_jenisbiaya',
            'siswa_ids' => 'required|array',
        ]);


        foreach ($request->siswa_ids as $id_kelashassiswa) {
            TagihanSiswa::create([
                'tgl_tagihan' => now(),
                'status' => 'Belum Lunas',
                'jenis_biaya_id_jenisbiaya' => $request->jenis_biaya,
                'kelas_has_siswa_id_kelashassiswa' => $id_kelashassiswa,
            ]);
        }
        return redirect()->route('tagihan.view')->with('success', 'Tagihan berhasil digenerate.');
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
    public function destroy($id)
    {
        $tagihan = TagihanSiswa::findOrFail($id);
        $tagihan->delete();

        return redirect()->route('tagihan.view')->with('success', 'Tagihan berhasil dihapus.');
    }
}
