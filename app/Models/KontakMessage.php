<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['nama', 'email', 'telepon', 'pesan'])]
class KontakMessage extends Model
{
    protected $table = 'kontak_messages';
}
