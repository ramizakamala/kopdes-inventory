<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('barang', function (Blueprint $table) {
            $table->text('deskripsi')->nullable()->after('satuan');
            $table->string('foto_path')->nullable()->after('deskripsi');
            $table->boolean('tampil_publik')->default(true)->after('foto_path');
        });
    }

    public function down(): void
    {
        Schema::table('barang', function (Blueprint $table) {
            $table->dropColumn(['deskripsi', 'foto_path', 'tampil_publik']);
        });
    }
};
