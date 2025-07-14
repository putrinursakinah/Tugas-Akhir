<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataAnggaran extends Model
{
    use HasFactory;
    protected $table = 'data_anggaran';
    protected $fillable= ['kode', 'uraian', 'vol','satuan', 'harga_satuan', 'jumlah'];
    public function kodeAkun()
    {
        return $this->belongsTo(KodeAkun::class, 'kode_akun_id_akun');
    }
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'data_anggaran_id');
    }
    public function history()
    {
        return $this->hasMany(History::class, 'data_anggaran_id');
    }
    public function komponen()
    {
        return $this->hasMany(Komponen::class, 'data_anggaran_id');
    }
}
