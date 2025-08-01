<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TahunAjaranKodeKegiatan;
use App\Models\TahunAjaran;

class TahunAjaranKodeKegiatanController extends Controller
{
    public function index()
    {
        $tahunAjaranList = TahunAjaran::orderBy('tahun', 'desc')->get();
        return view('backend.ajaran.add_ajaran', compact('tahunAjaranList'));
    }
    public function store(Request $request)
    {
        
        $tahun = $request->get('tahun');
        if ($tahun) {
            TahunAjaranKodeKegiatan::firstOrCreate(['tahun' => $tahun]);

            session(['tahun_aktif' => $tahun]);
        }
        return redirect()->back()->with('tahun', $tahun);
    }
    
}
