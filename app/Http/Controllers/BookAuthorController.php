<?php

namespace App\Http\Controllers;

use App\Models\BookAuthor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookAuthorController extends Controller
{
    /**
     * Display a listing of book author relations.
     * GET /api/book-authors
     */
    public function index()
    {
        $relations = BookAuthor::with(['book', 'author'])->get();
        return response()->json([
            'status' => true,
            'message' => 'Book authors retrieved successfully',
            'data' => $relations
        ], 200);
    }

    /**
     * Store a newly created book author relationship.
     * POST /api/book-authors
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'BookID' => 'required|exists:tblBook,BookID',
            'AuthorID' => 'required|exists:tblAuthor,AuthorID',
            'AuthorDate' => 'nullable|date',
            'Remark' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        // Check if combination already exists
        $exists = BookAuthor::where('BookID', $request->BookID)
            ->where('AuthorID', $request->AuthorID)
            ->exists();

        if ($exists) {
            return response()->json([
                'status' => false,
                'message' => 'This author is already assigned to this book'
            ], 409);
        }

        $bookAuthor = BookAuthor::create($validator->validated());

        return response()->json([
            'status' => true,
            'message' => 'Author successfully assigned to book',
            'data' => $bookAuthor->load(['book', 'author'])
        ], 201);
    }

    /**
     * Display relations for a specific BookID.
     * GET /api/book-authors/{bookId}
     */
    public function show($id)
    {
        $records = BookAuthor::where('BookID', $id)
            ->with(['book', 'author'])
            ->get();

        if ($records->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'No authors found for this book'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Book authors retrieved successfully',
            'data' => $records
        ], 200);
    }

    /**
     * Update relation by BookID (and AuthorID from request).
     * PUT/PATCH /api/book-authors/{bookId}
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'AuthorID' => 'required|exists:tblAuthor,AuthorID',
            'AuthorDate' => 'nullable|date',
            'Remark' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $record = BookAuthor::where('BookID', $id)
            ->where('AuthorID', $request->AuthorID)
            ->first();

        if (!$record) {
            return response()->json([
                'status' => false,
                'message' => 'Record not found for given BookID and AuthorID'
            ], 404);
        }

        $record->update([
            'AuthorDate' => $request->AuthorDate ?? $record->AuthorDate,
            'Remark' => $request->Remark ?? $record->Remark,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Book author relation updated successfully',
            'data' => $record->load(['book', 'author'])
        ], 200);
    }

    /**
     * Remove an author from a book.
     * DELETE /api/book-authors/{bookId}?AuthorID={authorId}
     */
    public function destroy(Request $request, $id)
    {
        $authorId = $request->query('AuthorID') ?? $request->input('AuthorID');

        $query = BookAuthor::where('BookID', $id);
        if ($authorId) {
            $query->where('AuthorID', $authorId);
        }

        $deletedCount = $query->delete();

        if ($deletedCount === 0) {
            return response()->json([
                'status' => false,
                'message' => 'Record not found to delete'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Book author relation removed successfully'
        ], 200);
    }
}
