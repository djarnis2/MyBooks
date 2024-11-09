<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class BookController extends Controller
{
    public function index(): View|Factory|Application
    {
        return view('index');
    }
    public function addBook(): View|Factory|Application
    {
        $authors = Author::all();
        return view('create', ['authors' => $authors]);
    }
    public function getBooks(): View|Factory|Application
    {
        $allBooks = Book::all();
        return view('books',['books' => $allBooks]);
    }



    public function store(Request $request): RedirectResponse
    {
        Log::info('Starting book store process');

        $validated = $request->validate([
            'title' => 'required|max:255',
            'author_id' => ['nullable', function ($attribute, $value, $fail) {
                if ($value !== 'new' && !Author::where('id', $value)->exists()) {
                    $fail('Invalid author');
                } // checking if author_id is new or id exists. else: fail
            }],
            'new_author_name' => 'nullable|string|max:255',
            'birth_date' => 'nullable|date',
            'death_date' => 'nullable|date',
            'description' => 'nullable|string',
        ]);

        Log::info('Validation passed', $validated);

        $author_id = $request->input('author_id');

        if ($author_id === 'new' && $request->filled('new_author_name')) {
            Log::info('Creating new author');

            $author = Author::create([
                'name' => $request->input('new_author_name'),
                'birth_date' => $request->input('birth_date'),
                'death_date' => $request->input('death_date'),
                'description' => $request->input('description'),
            ]);
            $author_id = $author->id;
            Log::info('New author created with ID:', ['id' => $author_id]);
        }

        $book = Book::create([
            'title' => $request->input('title'),
            'author_id' => $author_id,
        ]);
        Log::info('Book created successfully', ['book_id' => $book->id]);

        return redirect()->route('books.index')->with('success', 'Book "' . $book->title . '" added successfully');
    }

    public function show($id): View|Factory|Application
    {
        $book = Book::find($id);

        if(!$book){
            Log::warning("Book with {$id} not found");
            return view('show', ['error' => "Book with {$id} not found"]);
        }

            return view('show', ['book' => $book]);
    }
}


