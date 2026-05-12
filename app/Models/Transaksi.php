<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        'user_id',
        'tiket_id',
        'jumlah',
        'total_harga',
        'status',
        'admin_id',
        'created_at',
        'updated_at',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function tiket() {
        return $this->belongsTo(Tiket::class);
    }

    public function admin() {
        return $this->belongsTo(Admin::class);
    }
}