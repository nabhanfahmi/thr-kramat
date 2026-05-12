<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('galeris', function (Blueprint $table) {
            $table->foreignId('admin_id')
                ->nullable() // boleh null jika tidak wajib diisi
                ->after('id') // posisinya setelah kolom id
                ->constrained('admins')
                ->onDelete('set null'); // jika admin dihapus, jadikan null
        });
    }

    public function down(): void
    {
        Schema::table('galeris', function (Blueprint $table) {
            $table->dropForeign(['admin_id']);
            $table->dropColumn('admin_id');
        });
    }
};