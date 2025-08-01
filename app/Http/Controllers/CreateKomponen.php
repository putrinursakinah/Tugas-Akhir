<?php

namespace App\Http\Controllers;

use App\Models\DataAnggaran;
use App\Models\KodeAkun;
use App\Models\KodeKegiatan;
use App\Models\Komponen;

class CreateKomponen
{
    public static function createKomponen($request)
    {
        return Komponen::create([
            'kode' => $request->komponen_kode,
            'uraian' => $request->komponen_uraian,
            'kode_kegiatan_id_kegiatan' => $request->kegiatan_id,
            'kode_akun_id_akun' => $request->akun_id,
        ]);
    }
}