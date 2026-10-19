<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    /**
     * Display a listing of books with their type and authors.
     * GET /api/books
     */
    public function index()
    {
        $books = Book::with(['bookType', 'authors'])->get();
        return response()->json([
            'status' => true,
            'message' => 'Books retrieved successfully',
            'data' => $books
        ], 200);
    }

    /**
     * Store a newly created book.
     * POST /api/books
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'BookTitle' => 'required|string|max:255',
            'BookTypeID' => 'required|exists:tblBookType,BookTypeID',
            'PublishDate' => 'nullable|date',
            'NumOfPages' => 'nullable|integer|min:1',
            'NumOfCopies' => 'nullable|integer|min:0',
            'Edition' => 'nullable|string|max:100',
            'Publisher' => 'nullable|string|max:255',
            'BookSource' => 'nullable|string|max:255',
            'Remark' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $book = Book::create($validator->validated());

        return response()->json([
            'status' => true,
            'message' => 'Book created successfully',
            'data' => $book->load('bookType')
        ], 201);
    }

    /**
     * Display the specified book.
     * GET /api/books/{id}
     */
    public function show($id)
    {
        $book = Book::with(['bookType', 'authors'])->find($id);

        if (!$book) {
            return response()->json([
                'status' => false,
                'message' => 'Book not found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Book retrieved successfully',
            'data' => $book
        ], 200);
    }

    /**
     * Update the specified book.
     * PUT/PATCH /api/books/{id}
     */
    public function update(Request $request, $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'status' => false,
                'message' => 'Book not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'BookTitle' => 'sometimes|required|string|max:255',
            'BookTypeID' => 'sometimes|required|exists:tblBookType,BookTypeID',
            'PublishDate' => 'nullable|date',
            'NumOfPages' => 'nullable|integer|min:1',
            'NumOfCopies' => 'nullable|integer|min:0',
            'Edition' => 'nullable|string|max:100',
            'Publisher' => 'nullable|string|max:255',
            'BookSource' => 'nullable|string|max:255',
            'Remark' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $book->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Book updated successfully',
            'data' => $book->load(['bookType', 'authors'])
        ], 200);
    }

    /**
     * Remove the specified book.
     * DELETE /api/books/{id}
     */
    public function destroy($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'status' => false,
                'message' => 'Book not found'
            ], 404);
        }

        $book->delete();

        return response()->json([
            'status' => true,
            'message' => 'Book deleted successfully'
        ], 200);
    }
}
