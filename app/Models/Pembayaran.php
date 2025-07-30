<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $table = 'pembayaran';
    protected $primaryKey = 'id_pembayaran';
    protected $fillable = ['tgl_pembayaran', 'tagihan_siswa_id_tagihan', 'transaksi_id_transaksi'];
    public function tagihanSiswa()
    {
        return $this->belongsTo(TagihanSiswa::class, 'tagihan_siswa_id_tagihan');
    }
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id_transaksi');
    }
}
