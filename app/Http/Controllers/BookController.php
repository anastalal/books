<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;


class BookController extends Controller
{
    // Fetch all books
    public function index()
    {
        $books = Book::all();
        return response()->json($books, 200);
    }

    // Fetch a single book by ID
    public function show($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        return response()->json($book, 200);
    }

    // Create a new book
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
            'year_published' => 'required|integer',
            // 'cover_image' => 'nullable|url',
            'user_id' => 'required|exists:users,id',
        ]);

        $book = Book::create($validated);

        return response()->json(['message' => 'Book created successfully', 'book' => $book], 201);
    }

    // Update an existing book
    public function update(Request $request, $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'author' => 'sometimes|required|string|max:255',
            'category' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'year_published' => 'sometimes|required|integer',
            'image' => 'nullable|url',
            'user_id' => 'sometimes|required|exists:users,id',
        ]);

        $book->update($validated);

        return response()->json(['message' => 'Book updated successfully', 'book' => $book], 200);
    }

    // Delete a book
    public function destroy($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        $book->delete();

        return response()->json(['message' => 'Book deleted successfully'], 200);
    }
}
