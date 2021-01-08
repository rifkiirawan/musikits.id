<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_pengguna', 'alamat', 'no_telp', 'id_line','jenis_kelamin', 'role', 'status', 'id_admin'
    ];
    protected $table = 'pengguna';
}
