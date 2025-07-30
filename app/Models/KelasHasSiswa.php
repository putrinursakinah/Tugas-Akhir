<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasHasSiswa extends Model
{
    use HasFactory;

    protected $table = 'kelas_has_siswa';
    protected $primaryKey = 'id_kelashassiswa';
    public $timestamps = true;

    protected $fillable = [
        'kelas_id',
        'siswa_id',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id_kelas', 'id_kelas');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id_siswa', 'id_siswa');
    }

    public function tagihan()
    {
        return $this->hasMany(TagihanSiswa::class, 'kelas_has_siswa_id_kelashassiswa', 'id_kelashassiswa');
    }
}
