<?php
namespace App\Http\Controllers;

class KomponenSementaraSimpan
{
    public static function simpan(array $data, $selectedKegiatan): void
    {
        $komponens = session()->get('komponen_sementara', []);

        $komponens[] = [
            'id' => uniqid(),
            'kode' => $data['kode'],
            'uraian' => $data['uraian'],
            'kegiatan_id' => $data['kegiatan_id'],
            'kegiatan_kode' => $selectedKegiatan ? $selectedKegiatan->kode : '',
            'kegiatan_nama' => $selectedKegiatan ? $selectedKegiatan->kegiatan : '',
        ];

        session()->put('komponen_sementara', $komponens);
    }
}