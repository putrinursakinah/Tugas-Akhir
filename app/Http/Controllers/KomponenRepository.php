<?php
namespace App\Http\Controllers;


use App\Models\Komponen;


class KomponenRepository
{
  public static function getKomponenByKegiatan($kegiatan){

    
        $kegiatanIds = $kegiatan->pluck('id_kegiatan');

       return  Komponen::whereIn('kode_kegiatan_id_kegiatan', $kegiatanIds)->get();
        
  }


}