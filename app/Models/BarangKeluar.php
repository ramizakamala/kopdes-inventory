<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['tanggal', 'barang_id', 'jumlah', 'harga_jual', 'keterangan', 'user_id'])]
class BarangKeluar extends Model
{
    use HasFactory;

    protected $table = 'barang_keluar';

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
            'jumlah' => 'integer',
            'harga_jual' => 'decimal:2',
        ];
    }

    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
