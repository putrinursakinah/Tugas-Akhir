<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';
    public function kategoriKas() {
        return $this->hasMany(KategoriKas::class, 'kategori_id_kategori');
    }
    public function kodeKegiatan() {
        return $this->hasMany(KodeKegiatan::class, 'kategori_id_kategori');
    }
}
