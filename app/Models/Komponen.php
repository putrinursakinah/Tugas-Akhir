<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komponen extends Model
{
    use HasFactory;
    protected $table = 'komponen';
    protected $primaryKey = 'id_komponen';
    public function kodeKegiatan() {
        return $this->belongsTo(KodeKegiatan::class, 'kode_kegiatan_id_kegiatan');
    }
    public function kodeAkun() {
        return $this->hasMany(KodeAkun::class, 'komponen_id_komponen');
    }
}
