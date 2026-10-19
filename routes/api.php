<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookTypeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookAuthorController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| Routes for tblAuthor, tblBookType, tblBook, tblBookAuthor
| All 5 CRUD methods (index, store, show, update, destroy)
*/

Route::apiResource('authors', AuthorController::class);
Route::apiResource('book-types', BookTypeController::class);
Route::apiResource('books', BookController::class);
Route::apiResource('book-authors', BookAuthorController::class);
