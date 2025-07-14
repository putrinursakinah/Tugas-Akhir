<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailAkun extends Model
{
    use HasFactory;
    protected $table = 'detail_akun';
    protected $primaryKey = 'id_akun';
    public function kodeAkun()
    {
        return $this->belongsTo(KodeAkun::class, 'kode_akun_id_akun');
    }
     public function transaksi() {
        return $this->hasMany(Transaksi::class, 'detail_akun_id_akun');
    }
}
