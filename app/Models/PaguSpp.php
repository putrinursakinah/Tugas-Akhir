<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaguSpp extends Model
{
    use HasFactory;
    protected $table = 'pagu_spp';
    protected $primaryKey = 'id_paguspp';

    protected $fillable = ['id_anggaran', 'id_tahun_ajaran_kode_kegiatan'];

    public function anggaran()
    {
        return $this->belongsTo(DataAnggaran::class, 'id_anggaran', 'id_anggaran');
    }
     public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaranKodeKegiatan::class, 'id_tahun_ajaran', 'id_tahun_ajaran_kode_kegiatan');
    }
}
