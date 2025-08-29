<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Book::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'genre' => 'required|array',
            'genre.*' => 'exists:genres,id',
        ]);

        $book = Book::create($validated);
        $book->genres()->attach($request->genre);

        return response()->json($book, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['error' => 'Book not found'], 404);
        }

        return response()->json($book);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['error' => 'Book not found'], 404);
        }

        $validated = $request->validate([
            'title' => 'string|max:255',
            'author_id' => 'exists:authors,id',
            'genre' => 'array',
            'genre.*' => 'exists:genres,id',
        ]);

        $book->update($validated);

        if ($request->has('genre')) {
            $book->genres()->sync($request->genre);
        }

        return response()->json($book);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['error' => 'Book not found'], 404);
        }

        $book->delete();

        return response()->json(['message' => 'Book deleted successfully']);
    }

}
