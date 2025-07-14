<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Identitas extends Model
{
    use HasFactory;
     protected $table = 'identitas';

    protected $fillable = [
    'nama_bendahara',
    'nip_bendahara',
    'nama_pimpinan',
    'nip_pimpinan',
    'jabatan_pimpinan',
    'nama_atasan_pimpinan',
    'jabatan_atasan_pimpinan',
    'nama_pejabat_komitmen',
    'nip_pejabat_komitmen',
    'jabatan_pejabat_komitmen',
    ];
}
