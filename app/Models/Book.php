<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'tblBook';
    protected $primaryKey = 'BookID';

    protected $fillable = [
        'BookTitle',
        'BookTypeID',
        'PublishDate',
        'NumOfPages',
        'NumOfCopies',
        'Edition',
        'Publisher',
        'BookSource',
        'Remark'
    ];

    /**
     * Relationship: A book belongs to a BookType
     */
    public function bookType()
    {
        return $this->belongsTo(BookType::class, 'BookTypeID', 'BookTypeID');
    }

    /**
     * Relationship: A book belongs to many authors via tblBookAuthor
     */
    public function authors()
    {
        return $this->belongsToMany(
            Author::class,
            'tblBookAuthor',
            'BookID',
            'AuthorID'
        )->withPivot('AuthorDate', 'Remark')->withTimestamps();
    }
}
