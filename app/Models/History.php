<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
    protected $table = 'history';
    public function dataAnggaran() {
        return $this->belongsTo(DataAnggaran::class, 'data_anggaran_id');
    }
}
