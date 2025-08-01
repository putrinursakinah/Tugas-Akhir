<?php
namespace App\Http\Controllers;

use App\Models\KodeAkun;

class AkunSementaraSimpan
{
    public static function simpan(int $id_akun, int $komponen_id): void
    {
         $akun = KodeAkun::find($id_akun);

         if (!$akun){
            return;
         }

        $akun_sementara = session()->get('akun_sementara', []);
        $akun_sementara[] = [
            'id' => uniqid(),
            'kode' => $akun->kode,
            'uraian' => $akun->uraian,
            'komponen_id' => $komponen_id,
        ];
        session()->put('akun_sementara', $akun_sementara);
    }
}