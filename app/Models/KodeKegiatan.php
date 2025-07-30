<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KodeKegiatan extends Model
{
    use HasFactory;
    protected $table = 'kode_kegiatan';
    protected $primaryKey = 'id_kegiatan';
    protected $fillable = ['kode', 'kegiatan', 'kategori_kegiatan', 'kategori_id_kategori', 'id_tahun_ajaran_kode_kegiatan'];
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id_kategori', 'id_kategori');
    }
    public function komponen()
    {
        return $this->hasMany(Komponen::class, 'kode_kegiatan_id_kegiatan');
    }
    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaranKodeKegiatan::class, 'id_tahun_ajaran_kode_kegiatan');
    }
    public function dataAnggaran()
    {
        return $this->hasMany(DataAnggaran::class, 'kode_kegiatan_id_kegiatan');
    }
}
