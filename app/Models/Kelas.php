<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_kelas';
    public function siswa() {
        return $this->belongsToMany(Siswa::class, 'kelas_has_siswa', 'kelas_id_kelas', 'siswa_id_siswa');
    }
    public function spp() {
        return $this->hasMany(Spp::class);
    }
}
