<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;
use App\Models\BookType;
use App\Models\Book;
use App\Models\BookAuthor;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database with sample data.
     */
    public function run(): void
    {
        // 1. Create Book Types
        $typeIt = BookType::create(['BookTypeName' => 'Information Technology']);
        $typeNov = BookType::create(['BookTypeName' => 'Novel & Literature']);
        $typeSci = BookType::create(['BookTypeName' => 'Science & Mathematics']);

        // 2. Create Authors
        $author1 = Author::create([
            'AuthorName' => 'Taylor Otwell',
            'Gender' => 'Male',
            'DOB' => '1986-06-07',
            'POB' => 'Arkansas, USA',
            'Address' => 'Little Rock, USA',
            'Phone' => '+1-555-0199',
            'Email' => 'taylor@laravel.com',
            'Photo' => 'taylor.jpg'
        ]);

        $author2 = Author::create([
            'AuthorName' => 'Martin Fowler',
            'Gender' => 'Male',
            'DOB' => '1963-12-18',
            'POB' => 'Walsall, UK',
            'Address' => 'Melrose, Massachusetts',
            'Phone' => '+1-555-0244',
            'Email' => 'fowler@thoughtworks.com',
            'Photo' => 'fowler.jpg'
        ]);

        // 3. Create Books
        $book1 = Book::create([
            'BookTitle' => 'Mastering Laravel 11 API',
            'BookTypeID' => $typeIt->BookTypeID,
            'PublishDate' => '2024-03-12',
            'NumOfPages' => 450,
            'NumOfCopies' => 100,
            'Edition' => '1st Edition',
            'Publisher' => 'Tech Books Publishing',
            'BookSource' => 'Purchased',
            'Remark' => 'Core handbook for REST API development'
        ]);

        $book2 = Book::create([
            'BookTitle' => 'Refactoring: Improving the Design of Existing Code',
            'BookTypeID' => $typeIt->BookTypeID,
            'PublishDate' => '2018-11-20',
            'NumOfPages' => 448,
            'NumOfCopies' => 50,
            'Edition' => '2nd Edition',
            'Publisher' => 'Addison-Wesley',
            'BookSource' => 'Donated',
            'Remark' => 'Classic programming engineering guide'
        ]);

        // 4. Assign Authors to Books (tblBookAuthor)
        BookAuthor::create([
            'BookID' => $book1->BookID,
            'AuthorID' => $author1->AuthorID,
            'AuthorDate' => '2024-03-01',
            'Remark' => 'Lead Author'
        ]);

        BookAuthor::create([
            'BookID' => $book2->BookID,
            'AuthorID' => $author2->AuthorID,
            'AuthorDate' => '2018-10-15',
            'Remark' => 'Primary Author'
        ]);
    }
}
