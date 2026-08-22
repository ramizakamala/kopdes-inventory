<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['barang_id', 'nomor_batch', 'tanggal_masuk', 'tanggal_kedaluwarsa', 'jumlah'])]
class Batch extends Model
{
    use HasFactory;

    protected $table = 'batch';

    protected function casts(): array
    {
        return [
            'tanggal_masuk' => 'date',
            'tanggal_kedaluwarsa' => 'date',
            'jumlah' => 'integer',
        ];
    }

    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}
