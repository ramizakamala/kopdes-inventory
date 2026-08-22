<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('barang_keluar', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->foreignId('barang_id')->constrained('barang')->cascadeOnDelete();
            $table->integer('jumlah');
            $table->decimal('harga_jual', 12, 2)->default(0);
            $table->string('keterangan')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barang_keluar');
    }
};
