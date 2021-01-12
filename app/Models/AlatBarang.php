<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlatBarang extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_alat', 'harga_sewa', 'gambar', 'status_barang', 'id_admin'
    ];
    protected $table = 'alat';
}
