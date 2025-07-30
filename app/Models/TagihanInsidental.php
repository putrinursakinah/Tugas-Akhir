<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagihanInsidental extends Model
{
    use HasFactory;
    protected $table = 'tagihan_insidental';
    protected $primaryKey = 'id_insidental';
    public $timestamps = false;

    public function users()
    {
        return $this->belongsTo(User::class, 'users_id_users');
    }
}
