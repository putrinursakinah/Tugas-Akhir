<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id_users';
    protected $fillable = ['name', 'email', 'password', 'role'];

    protected $hidden = ['password', 'remember_token'];
    protected $casts = ['email_verified_at' => 'datetime'];

    public function transaksi() {
        return $this->belongsTo(Transaksi::class, 'transaksi_no_bukti');
    }
    public function tagihanBulanan()
    {
        return $this->hasMany(TagihanBulanan::class, 'users_id_users');
    }
    public function tagihanTahunan()
    {
        return $this->hasMany(TagihanTahunan::class, 'users_id_users');
    }
    public function tagihanInsidental()
    {
        return $this->hasMany(TagihanInsidental::class, 'users_id_users');
    }
}
