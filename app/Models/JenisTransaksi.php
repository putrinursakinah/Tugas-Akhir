<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisTransaksi extends Model
{
    use HasFactory;
    protected $table = 'jenis_transaksi';
    protected $primaryKey = 'id_transaksi';
    public function transaksi() {
        return $this->hasMany(Transaksi::class, 'jenis_transaksi_id_transaksi');
    }
}
