<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('barang_keluar', function (Blueprint $table) {
            $table->decimal('hpp_satuan', 12, 2)->default(0)->after('harga_jual');
        });

        // backfill transaksi lama: HPP = harga beli barang saat ini
        DB::statement('UPDATE barang_keluar SET hpp_satuan = COALESCE((SELECT harga_beli FROM barang WHERE barang.id = barang_keluar.barang_id), 0) WHERE hpp_satuan = 0');
    }

    public function down(): void
    {
        Schema::table('barang_keluar', function (Blueprint $table) {
            $table->dropColumn('hpp_satuan');
        });
    }
};
