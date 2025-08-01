<?php
namespace App\Http\Controllers;

use App\Models\DataAnggaran;
use App\Models\KodeAkun;
use App\Models\KodeKegiatan;
use App\Models\Komponen;

class CreateDataAnggaran
{
    public static function createDataAnggaran($request, $komponenId)
    {
        return  DataAnggaran::create([
            'uraian' => $request->detail_uraian,
            'vol' => $request->detail_vol,
            'satuan' => $request->detail_satuan,
            'harga_satuan' => $request->detail_harga_satuan,
            'jumlah' => $request->detail_jumlah,
            'kode_kegiatan_id_kegiatan' => $request->kegiatan_id,
            'komponen_id_komponen' => $komponenId,
        ]);
    }
    }