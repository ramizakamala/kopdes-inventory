<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/** Alokasi pengambilan stok dari satu batch pada satu transaksi barang keluar (FEFO). */
#[Fillable(['barang_keluar_id', 'batch_id', 'jumlah'])]
class BarangKeluarBatch extends Model
{
    use HasFactory;

    protected $table = 'barang_keluar_batch';

    protected function casts(): array
    {
        return [
            'jumlah' => 'integer',
        ];
    }

    public function barangKeluar(): BelongsTo
    {
        return $this->belongsTo(BarangKeluar::class, 'barang_keluar_id');
    }

    public function batch(): BelongsTo
    {
        return $this->belongsTo(Batch::class, 'batch_id');
    }
}
