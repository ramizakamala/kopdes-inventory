<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang')->unique();
            $table->string('nama_barang');
            $table->foreignId('kategori_id')->nullable()->constrained('kategori')->nullOnDelete();
            $table->string('satuan')->default('pcs');
            $table->decimal('harga_beli', 12, 2)->default(0);
            $table->decimal('harga_jual', 12, 2)->default(0);
            $table->integer('stok_minimum')->default(0);
            $table->integer('stok_saat_ini')->default(0);
            $table->boolean('is_batch_tracked')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
