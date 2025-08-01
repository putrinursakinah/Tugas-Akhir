<?php
namespace App\Http\Controllers;

use App\Models\DataAnggaran;

class DetailStoreDataAnggaran
{
    public static function detailStore(array $data, int $akun_id): DataAnggaran

    {
        $kode_detail_full = $data['kode_detail'] . '.' . $data['kode_urut'];

        $detail = DataAnggaran::create([
            'parent_id' => $akun_id,
            'kode_akun' => $kode_detail_full,
            'uraian' => $data['uraian_detail'],
            'vol' => $data['vol'],
            'satuan' => $data['satuan'],
            'harga_satuan' => $data['harga_satuan'],
            'jumlah' => $data['jumlah'],
        ]);

        $detail->updateParentTotals();

        return $detail;
    }
}
