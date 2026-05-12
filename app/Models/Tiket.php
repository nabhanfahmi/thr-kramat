<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tiket extends Model
{
    protected $table = 'tikets'; // pastikan sesuai nama tabel

    protected $fillable = [
        'nama_tiket',
        'kategori',
        'deskripsi',
        'harga',
        'stok',
    ];
}
