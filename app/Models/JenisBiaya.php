<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisBiaya extends Model
{
    use HasFactory;
    protected $table = 'jenis_biaya';
    protected $primaryKey = 'id_jenisbiaya';
    protected $fillable = ['nama', 'nominal', 'periode_pembayaran'];
    public function tagihanSiswa()
    {
        return $this->hasMany(TagihanSiswa::class, 'jenis_biaya_id_jenisbiaya');
    }
}
