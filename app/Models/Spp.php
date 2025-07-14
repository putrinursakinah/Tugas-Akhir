<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spp extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_spp';
    public function kelas() {
        return $this->belongsTo(Kelas::class, 'kelas_id_kelas');
    }
    public function transaksi() {
        return $this->belongsTo(Transaksi::class, 'transaksi_id_transaksi');
    }
}
