<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAjaranKodeKegiatan extends Model
{
    use HasFactory;
    protected $table = 'tahun_ajaran_kode_kegiatan';
    protected $primaryKey = 'id_tahun_ajaran_kode_kegiatan';
    protected $fillable = [
        'tahun',
    ];
    public function kodeKegiatan()
    {
        return $this->hasMany(KodeKegiatan::class, 'id_tahun_ajaran_kode_kegiatan');
    }
     public function paguSpp()
    {
        return $this->hasMany(PaguSpp::class, 'id_tahun_ajaran', 'id_tahun_ajaran_kode_kegiatan');
    }
}
