<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tikets', function (Blueprint $table) {
            $table->id();
            $table->string('nama_tiket');
            $table->enum('kategori', ['Tiket Reguler', 'Tiket VIP', 'Tiket Anak-anak', 'Tiket Paket Keluarga'])->nullable();
            $table->decimal('harga', 10, 2);
            $table->unsignedInteger('stok');
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tikets');
    }
};
