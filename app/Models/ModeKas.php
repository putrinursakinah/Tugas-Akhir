<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModeKas extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_mode';
    public function kategoriKas()
    {
        return $this->hasMany(KategoriKas::class, 'mode_kas_id_mode');
    }
}
