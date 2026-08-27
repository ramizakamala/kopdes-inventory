<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('barang', function (Blueprint $table) {
            $table->integer('lead_time_hari')->default(3)->after('stok_minimum');
            $table->integer('safety_stock')->default(0)->after('lead_time_hari');
        });
    }

    public function down(): void
    {
        Schema::table('barang', function (Blueprint $table) {
            $table->dropColumn(['lead_time_hari', 'safety_stock']);
        });
    }
};
