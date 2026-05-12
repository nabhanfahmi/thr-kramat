<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    protected $table = 'pemesanans';

    protected $fillable = [
        'user_id',
        'tiket_id',
        'nama',
        'email',
        'jumlah_tiket',
        'tanggal_kunjungan',
        'no_hp',
        'total_harga',
        'status',
        'kode_transaksi',
        'payment_method',
        'payment_response',
        'kode_qr',
    ];

    protected $casts = [
        'payment_response' => 'array',
    ];

    // Relasi ke user
    public function tiket()
    {
        return $this->belongsTo(Tiket::class, 'tiket_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

}
