<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KodeAkun extends Model
{
    use HasFactory;
    protected $table = 'kode_akun';
    protected $primaryKey = 'id_akun';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'kode',
        'kegiatan',
        'kategori_id_kategori',
        'komponen_id_komponen',
    ];
    public function komponen()
    {
        return $this->belongsTo(Komponen::class, 'komponen_id_komponen');
    }
    public function detailAkun()
    {
        return $this->hasMany(DetailAkun::class, 'kode_akun_id_akun');
    }
    public function dataAnggaran()
    {
        return $this->hasMany(DataAnggaran::class, 'kode_akun_id_akun');
    }
}
