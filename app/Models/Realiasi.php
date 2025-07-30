<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Realiasi extends Model
{
    use HasFactory;
    protected $table = 'realisasi';
    protected $fillable = [
        'data_anggaran_id_anggaran',
        'tanggal',
        'jumlah',
        'keterangan',
    ];
    public function anggaran()
    {
        return $this->belongsTo(DataAnggaran::class, 'data_anggaran_id_anggaran');
    }
}
