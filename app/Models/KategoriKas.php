<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriKas extends Model
{
    use HasFactory;
    protected $table = 'kategori_kas';
    protected $primaryKey = 'id_kategorikas';
    public function modeKas() {
        return $this->belongsTo(ModeKas::class, 'mode_kas_id_mode');
    }
    public function kategori() {
        return $this->belongsTo(Kategori::class, 'kategori_id_kategori');
    }
}
