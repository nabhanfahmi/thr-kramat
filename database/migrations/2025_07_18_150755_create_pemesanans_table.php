<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemesanansTable extends Migration
{
    public function up(): void
    {
        Schema::create('pemesanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nama');
            $table->string('email');
            $table->string('no_hp');
            $table->date('tanggal_kunjungan');
            $table->integer('jumlah_tiket');
            $table->integer('total_harga');
            $table->enum('status', ['menunggu', 'dibayar', 'selesai', 'batal'])->default('menunggu');
            $table->string('kode_transaksi')->nullable();
            $table->foreignId('tiket_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pemesanans');
    }
}
