<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['nama_supplier', 'kontak', 'alamat', 'catatan'])]
class Supplier extends Model
{
    use HasFactory;

    protected $table = 'supplier';

    public function barangMasuks(): HasMany
    {
        return $this->hasMany(BarangMasuk::class);
    }
}
