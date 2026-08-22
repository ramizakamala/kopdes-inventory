<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['tanggal', 'barang_id', 'supplier_id', 'batch_id', 'jumlah', 'harga_beli', 'user_id'])]
class BarangMasuk extends Model
{
    use HasFactory;

    protected $table = 'barang_masuk';

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
            'jumlah' => 'integer',
            'harga_beli' => 'decimal:2',
        ];
    }

    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function batch(): BelongsTo
    {
        return $this->belongsTo(Batch::class, 'batch_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
