<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Printable;
use App\Models\DataAnggaran;
class PrintPdf extends Controller implements Printable
{

    public function print(){
         $dataAnggaran = DataAnggaran::with([
            'komponen',
            'kegiatan',
            'parent',
        ])->get();

        $total = $dataAnggaran->sum('jumlah');

        echo view('backend.rkas.cetak_rkas', compact('dataAnggaran', 'total'));
    }
   

}