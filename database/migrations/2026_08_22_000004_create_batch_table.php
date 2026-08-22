<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('batch', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barang_id')->constrained('barang')->cascadeOnDelete();
            $table->string('nomor_batch');
            $table->date('tanggal_masuk');
            $table->date('tanggal_kedaluwarsa');
            $table->integer('jumlah');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('batch');
    }
};
