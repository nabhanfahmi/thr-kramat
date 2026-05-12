<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Petugas extends Authenticatable
{
    use Notifiable;

    protected $table = 'petugas'; // nama tabelnya

    protected $fillable = [
        'name',
        'email',
        'password',
        // field lain jika ada
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Kalau mau otomatis hashing password bisa override setPasswordAttribute
    // public function setPasswordAttribute($password)
    // {
    //     $this->attributes['password'] = bcrypt($password);
    // }
}
