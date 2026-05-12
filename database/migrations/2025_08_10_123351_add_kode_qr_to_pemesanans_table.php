<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pemesanans', function (Blueprint $table) {
            $table->string('kode_qr')->nullable()->unique()->after('id');
            $table->enum('status', ['menunggu', 'dibayar', 'selesai', 'tiket terpakai'])
                  ->default('menunggu')
                  ->change();
        });
    }

    public function down(): void
    {
        Schema::table('pemesanans', function (Blueprint $table) {
            $table->dropColumn('kode_qr');
        });
    }
};

