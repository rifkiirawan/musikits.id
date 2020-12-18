<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori_id',
        "judul",
        'konten',
        'slug',
        'gambar',
        'is_featured',
        'is_published'
    ];

    /**
     * Get the category that owns the post.
     */
    public function kategoris()
    {
        return $this->belongsTo('App\Models\Kategori');
    }
}
