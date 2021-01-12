<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sewa_Studio extends Model
{
    use HasFactory;
    protected $fillable = [
        'status', 'waktu_mulai', 'waktu_selesai','id_admin', 'id_pengguna'
    ];
    protected $table = 'sewa_studio';
}
