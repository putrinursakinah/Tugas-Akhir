<?php

namespace App\Http\Controllers;

use App\Models\KodeKegiatan;

class DetailTambahSessionService
{
    public static function getDetailTambahSession($akun_id)
    {
        $akun = collect(session('akun_sementara', []))->firstWhere('id', $akun_id);

        if (!$akun) {
            return null;
        }

        // Ambil komponen dari session
        $komponen = collect(session('komponen_sementara', []))->firstWhere('id', $akun['komponen_id']);
        $kegiatan = null;
        $kategori = null;
        if ($komponen) {
            $kegiatan = KodeKegiatan::find($komponen['kegiatan_id']);
            $kategori = $kegiatan?->kategori;
        }

        return compact('akun', 'komponen', 'kegiatan', 'kategori');
    }
}
