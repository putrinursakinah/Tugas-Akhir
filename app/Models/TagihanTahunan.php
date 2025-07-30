<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagihanTahunan extends Model
{
    use HasFactory;
    protected $table = 'tagihan_tahunan';
    protected $primaryKey = 'id_tahunan';
    public $timestamps = false;

    public function tagihanSiswa()
    {
        return $this->hasMany(TagihanSiswa::class, 'tagihan_siswa_id_tagihan');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'users_id_users');
    }
}
