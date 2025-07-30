<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $table = 'kelas';
    protected $primaryKey = 'id_kelas';
    protected $fillable = ['nama', 'tingkat', 'jurusan', 'tahun_ajaran'];
    public function siswa() {
       return $this->belongsToMany(Siswa::class, 'kelas_has_siswa', 'kelas_id_kelas', 'siswa_id_siswa')
                    ->withPivot('id_kelashassiswa')
                    ->withTimestamps();
    }
    public function spp() {
        return $this->hasMany(Spp::class);
    }
}
