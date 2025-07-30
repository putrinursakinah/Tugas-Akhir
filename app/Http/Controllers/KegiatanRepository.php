<?php
namespace App\Http\Controllers;

use App\Models\KodeKegiatan;

 
class KegiatanRepository 
{
 
 public static function getKegiatanByTahunAjaran($id_tahun_ajaran)
 {
    
 return  KodeKegiatan::where('id_tahun_ajaran_kode_kegiatan', $id_tahun_ajaran)->get();

 }
 

}