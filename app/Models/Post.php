<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'content', 
        'image', 
        'is_published', 
        'category_id',
    ];

    // Casting untuk memastikan `is_published` berupa boolean
    protected $casts = [
        'is_published' => 'boolean',
    ];

    // Relasi postingan milik satu kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    //Relasi Authors
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

}
