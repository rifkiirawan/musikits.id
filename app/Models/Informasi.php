<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informasi extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama', 'subjudul','deskripsi', 'gambar', 'tipe','id_admin'
    ];
    protected $table = 'informasi';
}
