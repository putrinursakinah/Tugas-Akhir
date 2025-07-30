<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    protected $fillable = [
        'no_bukti',
        'tanggal',
        'uraian',
        'debet',
        'kredit',
        'jenis_transaksi_id_transaksi',
        'detail_akun_id_akun',
        'data_anggaran_id',
        'kuitansi',
        'penerima_uang',
        'jabatan_penerima_uang',
    ];
    public function jenisTransaksi() {
        return $this->belongsTo(JenisTransaksi::class, 'jenis_transaksi_id_transaksi');
    }
    public function detailAkun() {
        return $this->belongsTo(DetailAkun::class, 'detail_akun_id_akun');
    }
    public function dataAnggaran() {
        return $this->belongsTo(DataAnggaran::class, 'data_anggaran_id');
    }
     public function spp() {
        return $this->hasOne(Spp::class, 'transaksi_id_transaksi');
    }
    public function pembayaran() {
        return $this->hasMany(Pembayaran::class, 'transaksi_id_transaksi');
    }
}
