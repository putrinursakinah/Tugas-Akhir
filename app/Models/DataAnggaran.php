<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataAnggaran extends Model
{
    use HasFactory;
    protected $table = 'data_anggaran';
    protected $primaryKey = 'id_anggaran';
    protected $fillable = ['uraian', 'vol', 'satuan', 'harga_satuan', 'jumlah', 'pengeluaran', 'kode_kegiatan_id_kegiatan', 'komponen_id_komponen'];
    public function kodeAkun()
    {
        return $this->belongsTo(KodeAkun::class, 'kode_akun_id_akun');
    }
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'data_anggaran_id');
    }
    public function history()
    {
        return $this->hasMany(History::class, 'data_anggaran_id');
    }
    public function komponen()
    {
        return $this->belongsTo(Komponen::class, 'komponen_id_komponen', 'id_komponen');
    }
    public function kegiatan()
    {
        return $this->belongsTo(KodeKegiatan::class, 'kode_kegiatan_id_kegiatan', 'id_kegiatan');
    }
    public function parent()
    {
        return $this->belongsTo(DataAnggaran::class, 'parent_id');
    }
    public function children()
    {
        return $this->hasMany(DataAnggaran::class, 'parent_id');
    }
    public function paguSpp()
    {
        return $this->hasMany(PaguSpp::class, 'data_anggaran_id_anggaran', 'id_anggaran');
    }
    public function realisasi()
    {
        return $this->hasMany(Realiasi::class, 'data_anggaran_id_anggaran', 'id_anggaran');
    }
}
