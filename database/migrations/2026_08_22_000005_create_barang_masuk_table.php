<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('barang_masuk', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->foreignId('barang_id')->constrained('barang')->cascadeOnDelete();
            $table->foreignId('supplier_id')->nullable()->constrained('supplier')->nullOnDelete();
            $table->foreignId('batch_id')->nullable()->constrained('batch')->nullOnDelete();
            $table->integer('jumlah');
            $table->decimal('harga_beli', 12, 2)->default(0);
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barang_masuk');
    }
};
