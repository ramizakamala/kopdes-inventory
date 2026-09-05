<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['tanggal', 'barang_id', 'jumlah', 'harga_jual', 'hpp_satuan', 'keterangan', 'user_id'])]
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
            'hpp_satuan' => 'decimal:2',
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

    /** Rincian batch yang terpakai pada transaksi ini (FEFO). */
    public function detailBatch(): HasMany
    {
        return $this->hasMany(BarangKeluarBatch::class, 'barang_keluar_id');
    }

    /** Batch-batch sumber stok (via tabel alokasi). */
    public function batches(): BelongsToMany
    {
        return $this->belongsToMany(Batch::class, 'barang_keluar_batch', 'barang_keluar_id', 'batch_id')
            ->withPivot('jumlah');
    }
}
