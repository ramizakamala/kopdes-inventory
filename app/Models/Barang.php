<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'kode_barang',
    'nama_barang',
    'kategori_id',
    'satuan',
    'harga_beli',
    'harga_jual',
    'stok_minimum',
    'stok_saat_ini',
    'is_batch_tracked',
])]
class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';

    protected function casts(): array
    {
        return [
            'harga_beli' => 'decimal:2',
            'harga_jual' => 'decimal:2',
            'stok_minimum' => 'integer',
            'stok_saat_ini' => 'integer',
            'is_batch_tracked' => 'boolean',
        ];
    }

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function batches(): HasMany
    {
        return $this->hasMany(Batch::class, 'barang_id');
    }

    public function barangMasuks(): HasMany
    {
        return $this->hasMany(BarangMasuk::class, 'barang_id');
    }

    public function barangKeluars(): HasMany
    {
        return $this->hasMany(BarangKeluar::class, 'barang_id');
    }

    public function stockAdjustments(): HasMany
    {
        return $this->hasMany(StockAdjustment::class, 'barang_id');
    }

    /** Status stok: habis | menipis | aman */
    public function getStatusAttribute(): string
    {
        if ($this->stok_saat_ini <= 0) {
            return 'habis';
        }
        if ($this->stok_saat_ini < $this->stok_minimum) {
            return 'menipis';
        }

        return 'aman';
    }
}
