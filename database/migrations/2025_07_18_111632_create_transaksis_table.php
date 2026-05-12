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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // pembeli
            $table->foreignId('tiket_id')->constrained()->onDelete('cascade'); // tiket yang dibeli
            $table->integer('jumlah'); // jumlah tiket
            $table->decimal('total_harga', 10, 2); // total harga = harga * jumlah
            $table->enum('status', ['menunggu', 'dibayar', 'selesai', 'batal'])->default('menunggu'); // status transaksi
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
