<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $table = 'siswa';
    protected $primaryKey = 'id_siswa';
    protected $fillable = ['nis', 'nama', 'alamat', 'telepon', 'angkatan'];
    public function spp()
    {
        return $this->hasMany(Spp::class, 'id_siswa');
    }
    public function tagihanSiswa()
    {
        return $this->hasMany(TagihanSiswa::class, 'siswa_id_siswa', 'id_siswa');
    }
    public function kelasHasSiswa()
    {
        return $this->hasMany(KelasHasSiswa::class, 'siswa_id_siswa');
    }

    // Ambil satu kelas aktif (jika hanya satu kelas aktif per siswa)
    public function kelas()
    {
        return $this->belongsToMany(Kelas::class, 'kelas_has_siswa', 'siswa_id_siswa', 'kelas_id')
            ->withPivot('id_kelashassiswa'); // jika ingin akses ID pivot-nya
    }
}
