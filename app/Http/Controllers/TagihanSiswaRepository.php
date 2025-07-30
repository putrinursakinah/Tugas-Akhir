<?php

namespace App\Http\Controllers;

use App\Models\TagihanSiswa;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\JenisBiaya;
use App\Models\Kelas;
use App\Models\KelasHasSiswa;
use App\Http\Requests\TagihanGenerateRequest;


class TagihanSiswaRepository
{
    public static function generate(array $siswaIds, int $jenisBiayaId): void
    {
        foreach ($siswaIds as $id_kelashassiswa) {
            TagihanSiswa::create([
                'tgl_tagihan' => now(),
                'status' => 'Belum Lunas',
                'jenis_biaya_id_jenisbiaya' => $jenisBiayaId,
                'kelas_has_siswa_id_kelashassiswa' => $id_kelashassiswa,
            ]);
        }
    }
    public static function getKelasList()
    {
        return Kelas::pluck('nama', 'id_kelas');
    }
    public static function getjenisBiayaList()
    {
        return JenisBiaya::all();
    }
    public static function getSiswaByKelas($kelasId)
    {
        return KelasHasSiswa::with(['siswa', 'kelas'])
            ->where('kelas_id_kelas', $kelasId)
            ->get();
    }
    public static function generateTagihan(array $siswaIds, int $jenisBiayaId)
    {
        foreach ($siswaIds as $id_kelashassiswa) {
            TagihanSiswa::create([
                'tgl_tagihan' => now(),
                'status' => 'Belum Lunas',
                'jenis_biaya_id_jenisbiaya' => $jenisBiayaId,
                'kelas_has_siswa_id_kelashassiswa' => $id_kelashassiswa,
            ]);
        }
    }
}
