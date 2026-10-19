<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookAuthor extends Model
{
    use HasFactory;

    protected $table = 'tblBookAuthor';
    public $incrementing = false;

    protected $fillable = [
        'BookID',
        'AuthorID',
        'AuthorDate',
        'Remark'
    ];

    /**
     * Relationship: Book
     */
    public function book()
    {
        return $this->belongsTo(Book::class, 'BookID', 'BookID');
    }

    /**
     * Relationship: Author
     */
    public function author()
    {
        return $this->belongsTo(Author::class, 'AuthorID', 'AuthorID');
    }
}
