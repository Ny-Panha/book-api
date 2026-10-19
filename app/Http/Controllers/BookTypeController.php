<?php

namespace App\Http\Controllers;

use App\Models\BookType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookTypeController extends Controller
{
    /**
     * Display a listing of book types.
     * GET /api/book-types
     */
    public function index()
    {
        $types = BookType::with('books')->get();
        return response()->json([
            'status' => true,
            'message' => 'Book types retrieved successfully',
            'data' => $types
        ], 200);
    }

    /**
     * Store a newly created book type.
     * POST /api/book-types
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'BookTypeName' => 'required|string|max:255|unique:tblBookType,BookTypeName',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $bookType = BookType::create($validator->validated());

        return response()->json([
            'status' => true,
            'message' => 'Book type created successfully',
            'data' => $bookType
        ], 201);
    }

    /**
     * Display the specified book type.
     * GET /api/book-types/{id}
     */
    public function show($id)
    {
        $bookType = BookType::with('books')->find($id);

        if (!$bookType) {
            return response()->json([
                'status' => false,
                'message' => 'Book type not found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Book type retrieved successfully',
            'data' => $bookType
        ], 200);
    }

    /**
     * Update the specified book type.
     * PUT/PATCH /api/book-types/{id}
     */
    public function update(Request $request, $id)
    {
        $bookType = BookType::find($id);

        if (!$bookType) {
            return response()->json([
                'status' => false,
                'message' => 'Book type not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'BookTypeName' => 'required|string|max:255|unique:tblBookType,BookTypeName,' . $id . ',BookTypeID',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $bookType->update($validator->validated());

        return response()->json([
            'status' => true,
            'message' => 'Book type updated successfully',
            'data' => $bookType
        ], 200);
    }

    /**
     * Remove the specified book type.
     * DELETE /api/book-types/{id}
     */
    public function destroy($id)
    {
        $bookType = BookType::find($id);

        if (!$bookType) {
            return response()->json([
                'status' => false,
                'message' => 'Book type not found'
            ], 404);
        }

        $bookType->delete();

        return response()->json([
            'status' => true,
            'message' => 'Book type deleted successfully'
        ], 200);
    }
}
