<?php
namespace App\Http\Controllers;

use App\Models\DataAnggaran;
use App\Models\KodeAkun;

use App\Models\Kategori;

class DataAnggaranRepository 
{
  public static function getDashboardData(){
$id_tahun_ajaran=1;
     $kategori = Kategori::all();
        $kegiatan = KegiatanRepository::getKegiatanByTahunAjaran($id_tahun_ajaran);
        $komponen = KomponenRepository::getKomponenByKegiatan($kegiatan);
        $dataanggaran =  DataAnggaranRepository::getDataAnggaranByKomponen( $komponen);
        $isLocked = $dataanggaran->first()?->is_locked ?? false;
        $kode_akun=KodeAkun::all();
        return compact('kategori', 'kegiatan', 'komponen', 'dataanggaran', 'kode_akun', 'isLocked');
  }

  public static function getDataAnggaranByKomponen($komponen){
    $komponenIds = $komponen->pluck('id_komponen');
       return DataAnggaran::whereIn('komponen_id_komponen', $komponenIds)->get();
  }


}