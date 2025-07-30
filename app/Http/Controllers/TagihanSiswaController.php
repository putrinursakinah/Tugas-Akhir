<?php

namespace App\Http\Controllers;

use App\Models\TagihanSiswa;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\JenisBiaya;
use App\Models\Kelas;
use App\Models\KelasHasSiswa;
use App\Http\Requests\TagihanGenerateRequest;

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
        $jenisBiayaList = TagihanSiswaRepository::getJenisBiayaList();
        $kelasList = TagihanSiswaRepository::getKelasList();

        $siswaList = [];

        if ($request->filled('kelas')) {
            $siswaList = TagihanSiswaRepository::getSiswaByKelas($request->kelas);
        }

        return view('backend.tagihan.generate_tagihan', compact('jenisBiayaList', 'kelasList', 'siswaList'));
    }

    public function generate(TagihanGenerateRequest $request)
    {
        TagihanSiswaRepository::generate($request->siswa_ids, $request->jenis_biaya);

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
        TagihanSiswaRepository::generateTagihan($request->siswa_ids, $request->jenis_biaya);
        
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
