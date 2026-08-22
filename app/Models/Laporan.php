<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['jenis_laporan', 'periode', 'tanggal_dibuat', 'user_id'])]
class Laporan extends Model
{
    use HasFactory;

    protected $table = 'laporan';

    protected function casts(): array
    {
        return [
            'tanggal_dibuat' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
