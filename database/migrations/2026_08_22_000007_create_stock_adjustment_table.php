<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stock_adjustment', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->foreignId('barang_id')->constrained('barang')->cascadeOnDelete();
            $table->integer('jumlah_penyesuaian'); // positif = tambah, negatif = kurang
            $table->string('alasan');
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_adjustment');
    }
};
