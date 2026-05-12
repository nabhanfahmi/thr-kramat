<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    // Jika nama tabel di database adalah 'heroes', bagian ini bisa dikosongkan
    // Tapi jika nama tabel berbeda (misal: 'hero'), un-comment baris di bawah:
    protected $table = 'heros';

    // Jika kamu ingin menentukan kolom yang bisa diisi
    protected $fillable = [
        'judul',
        'sub_judul',
        'gambar',
    ];
}
