<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['tanggal', 'barang_id', 'jumlah_penyesuaian', 'alasan', 'user_id'])]
class StockAdjustment extends Model
{
    use HasFactory;

    protected $table = 'stock_adjustment';

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
            'jumlah_penyesuaian' => 'integer',
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
