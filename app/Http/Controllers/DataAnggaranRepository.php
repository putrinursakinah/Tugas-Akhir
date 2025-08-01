<?php

namespace App\Http\Controllers;

use App\Models\DataAnggaran;
use App\Models\KodeAkun;
use App\Models\KodeKegiatan;
use App\Models\Komponen;


use App\Models\Kategori;

class DataAnggaranRepository
{
  public static function getDashboardData()
  {
    $id_tahun_ajaran = 1;
    $kategori = Kategori::all();
    $kegiatan = KegiatanRepository::getKegiatanByTahunAjaran($id_tahun_ajaran);
    $komponen = KomponenRepository::getKomponenByKegiatan($kegiatan);
    $dataanggaran =  DataAnggaranRepository::getDataAnggaranByKomponen($komponen);
    $isLocked = $dataanggaran->first()?->is_locked ?? false;
    $kode_akun = KodeAkun::all();
    return compact('kategori', 'kegiatan', 'komponen', 'dataanggaran', 'kode_akun', 'isLocked');
  }

  public static function getDataAnggaranByKomponen($komponen)
  {
    $komponenIds = $komponen->pluck('id_komponen');
    return DataAnggaran::whereIn('komponen_id_komponen', $komponenIds)->get();
  }

  public static function getFormData($kategori_id)
  {
    $kategori = Kategori::findOrFail($kategori_id);
    $kegiatan = KodeKegiatan::where('kategori_id_kategori', $kategori_id)->get();
    $kodeAkun = KodeAkun::all();

    return compact('kategori', 'kegiatan', 'kodeAkun', 'kategori_id');
  }

  public static function simpanDataAnggaran($request)
  {
        $kodeKegiatan = KodeKegiatan::find($request->kegiatan_id);
        $komponen = CreateKomponen::createKomponen($request);
        $akun = KodeAkun::find($request->akun_id);
        $detail = CreateDataAnggaran::createDataAnggaran($request, $komponen->id_komponen);

         return $detail;
  }
}
