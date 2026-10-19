<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'message' => 'Book Management API is running',
        'endpoints' => [
            'authors' => '/api/authors',
            'book_types' => '/api/book-types',
            'books' => '/api/books',
            'book_authors' => '/api/book-authors'
        ]
    ]);
});
