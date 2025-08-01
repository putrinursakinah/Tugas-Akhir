<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagihanSiswa extends Model
{
    use HasFactory;
    protected $table = 'tagihan_siswa';
    protected $primaryKey = 'id_tagihan';
    protected $fillable = ['tgl_tagihan', 'status', 'jenis_biaya_id_jenisbiaya', 'siswa_id_siswa', 'kelas_has_siswa_id_kelashassiswa'];

    public function jenisBiaya()
    {
        return $this->belongsTo(JenisBiaya::class, 'jenis_biaya_id_jenisbiaya', 'id_jenisbiaya');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id_siswa', 'id_siswa');
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'tagihan_siswa_id_tagihan', 'id_tagihan');
    }

    public function tagihanBulanan()
    {
        return $this->hasMany(TagihanBulanan::class, 'tagihan_siswa_id_tagihan');
    }

    public function tagihanTahunan()
    {
        return $this->hasMany(TagihanTahunan::class, 'tagihan_siswa_id_tagihan');
    }
    public function kelasHasSiswa()
    {
        return $this->belongsTo(KelasHasSiswa::class, 'kelas_has_siswa_id_kelashassiswa', 'id_kelashassiswa');
    }

}
