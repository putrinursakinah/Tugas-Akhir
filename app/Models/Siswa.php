<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_siswa';
    public function kelas() {
        return $this->belongsToMany(Kelas::class, 'kelas_has_siswa', 'siswa_id_siswa', 'kelas_id_kelas');
    }
    public function spp() {
        return $this->hasMany(Spp::class, 'id_siswa');
    }
}
