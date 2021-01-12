<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventarisDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'status_barang','id_alat', 'id_inventaris'
    ];
    protected $table = 'inventaris_detail';
}
