<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TahunAjaranKodeKegiatan;

class TahunAjaranKodeKegiatanController extends Controller
{
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
