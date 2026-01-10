<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    // Tambahkan 'image' di sini
    protected $fillable = [
        'title',
        'author',
        'image',
        'cover_image',
        'stock',
    ];


    // Relasi ke kategori (Many to Many)
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'book_category');
    }
}
