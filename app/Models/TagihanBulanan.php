<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagihanBulanan extends Model
{
    use HasFactory;
    protected $table = 'tagihan_bulanan';
    protected $primaryKey = 'id_tagihanbulan';
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
