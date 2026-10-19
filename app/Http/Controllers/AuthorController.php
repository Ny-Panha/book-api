<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    /**
     * Display a listing of authors.
     * GET /api/authors
     */
    public function index()
    {
        $authors = Author::with('books')->get();
        return response()->json([
            'status' => true,
            'message' => 'Authors retrieved successfully',
            'data' => $authors
        ], 200);
    }

    /**
     * Store a newly created author.
     * POST /api/authors
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'AuthorName' => 'required|string|max:255',
            'Gender' => 'nullable|string|max:10',
            'DOB' => 'nullable|date',
            'POB' => 'nullable|string|max:255',
            'Address' => 'nullable|string',
            'Phone' => 'nullable|string|max:30',
            'Email' => 'nullable|email|max:255',
            'Photo' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $author = Author::create($validator->validated());

        return response()->json([
            'status' => true,
            'message' => 'Author created successfully',
            'data' => $author
        ], 201);
    }

    /**
     * Display the specified author.
     * GET /api/authors/{id}
     */
    public function show($id)
    {
        $author = Author::with('books')->find($id);

        if (!$author) {
            return response()->json([
                'status' => false,
                'message' => 'Author not found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Author retrieved successfully',
            'data' => $author
        ], 200);
    }

    /**
     * Update the specified author.
     * PUT/PATCH /api/authors/{id}
     */
    public function update(Request $request, $id)
    {
        $author = Author::find($id);

        if (!$author) {
            return response()->json([
                'status' => false,
                'message' => 'Author not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'AuthorName' => 'sometimes|required|string|max:255',
            'Gender' => 'nullable|string|max:10',
            'DOB' => 'nullable|date',
            'POB' => 'nullable|string|max:255',
            'Address' => 'nullable|string',
            'Phone' => 'nullable|string|max:30',
            'Email' => 'nullable|email|max:255',
            'Photo' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $author->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Author updated successfully',
            'data' => $author
        ], 200);
    }

    /**
     * Remove the specified author.
     * DELETE /api/authors/{id}
     */
    public function destroy($id)
    {
        $author = Author::find($id);

        if (!$author) {
            return response()->json([
                'status' => false,
                'message' => 'Author not found'
            ], 404);
        }

        $author->delete();

        return response()->json([
            'status' => true,
            'message' => 'Author deleted successfully'
        ], 200);
    }
}
