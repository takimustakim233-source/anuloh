<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Borrowing;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';

    protected $fillable = [
        'title',
        'author',
        'publisher',
        'publication_year',
        'isbn',
        'stock',
        'description'
    ];

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }
}