<?php

namespace App\Http\Controllers;

use App\Models\KodeAkun;

class AkunSementaraStore
{
    public static function store(array $akun_ids, int $komponen_id): void
    {
       $akun_sementara = session()->get('akun_sementara', []);
        foreach ($akun_ids as $akun_id) {
            $akun = KodeAkun::where('id_akun', $akun_id)->first();
            if ($akun) {
                $akun_sementara[] = [
                    'id' => uniqid(),
                    'kode' => $akun->kode,
                    'uraian' => $akun->kegiatan,
                    'komponen_id' => $komponen_id,
                ];
            }
        }

        session()->put('akun_sementara', $akun_sementara);
    }
}
