<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komponen extends Model
{
    use HasFactory;
    protected $table = 'komponen';
    protected $primaryKey = 'id_komponen';
    protected $fillable = ['kode', 'uraian', 'kode_kegiatan_id_kegiatan', 'kode_akun_id_akun'];
    
    public function kodeKegiatan() {
        return $this->belongsTo(KodeKegiatan::class, 'kode_kegiatan_id_kegiatan', 'id_kegiatan');
    }
    public function kodeAkun() {
        return $this->belongsTo(KodeAkun::class, 'komponen_id_komponen', 'id_komponen');
    }
   
}
