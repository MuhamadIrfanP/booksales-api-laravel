<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'title',
        'author_id',
        'description',
        'price',
        'stock',
        'cover_photo',
        'genre_id',
        'author_id'
    ];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}