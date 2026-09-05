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
    'deskripsi',
    'foto_path',
    'tampil_publik',
    'harga_beli',
    'harga_jual',
    'stok_minimum',
    'lead_time_hari',
    'safety_stock',
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
            'lead_time_hari' => 'integer',
            'safety_stock' => 'integer',
            'stok_saat_ini' => 'integer',
            'is_batch_tracked' => 'boolean',
            'tampil_publik' => 'boolean',
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

    /** Total barang keluar 30 hari terakhir. */
    public function keluar30Hari(): int
    {
        return (int) $this->barangKeluars()
            ->where('tanggal', '>=', now()->subDays(30)->toDateString())
            ->sum('jumlah');
    }

    /** Rata-rata pemakaian per hari (30 hari terakhir). */
    public function rataPemakaianHarian(): float
    {
        return $this->keluar30Hari() / 30;
    }

    /**
     * Reorder Point: (rata² pemakaian harian × lead time) + safety stock,
     * tidak pernah di bawah stok minimum (jaring pengaman SRS).
     */
    public function rop(?int $keluar30Hari = null): int
    {
        $avg = ($keluar30Hari ?? $this->keluar30Hari()) / 30;
        $rop = (int) ceil($avg * $this->lead_time_hari) + $this->safety_stock;

        return max($rop, $this->stok_minimum);
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

    /**
     * Foto produk untuk website publik. Prioritas:
     * 1) foto hasil upload via form admin (storage/app/public/produk → /storage/produk),
     * 2) fallback file lama public/images/{slug}.jpg,
     * 3) null → view memakai ilustrasi <x-produk-art>.
     */
    public function getFotoAttribute(): ?string
    {
        if ($this->foto_path) {
            return asset('storage/' . $this->foto_path);
        }

        $file = 'images/' . \Illuminate\Support\Str::slug($this->nama_barang) . '.jpg';
        if (!file_exists(public_path($file))) {
            return null;
        }

        return asset($file);
    }
}
