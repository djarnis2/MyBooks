<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\File;
use App\Models\Genre;




class BookController extends Controller
{
    public function index(): View|Factory|Application
    {
        return view('index');
    }


//    public function addBook(): View|Factory|Application
//    {
//        $authors = Author::all();
//        return view('create', ['authors' => $authors]);
//    }

    public function create(): View|Factory|Application
    {
        $authors = Author::all();
        $genres = Genre::all(); // Get all genres
        return view('create', ['authors' => $authors, 'genres' => $genres]);
    }

    public function allBooks(User $user): View|Factory|Application
    {
        $allBooks = $user->books()->get();
        Log::info('user fetched successfully', ['user' => $user]);

        Log::info('Book fetched successfully', ['books' => $allBooks]);

        return view('books', ['books' => $allBooks]);
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
            'new_author_name' => 'nullable|string|max:255|unique:authors,name',
            'birth_date' => 'nullable|date',
            'death_date' => 'nullable|date',
            'description' => 'nullable',
            'type' => 'nullable|string',
            'language' => 'nullable|string',
            'notes' => 'nullable|string',
            'file' => 'nullable|file|image|mimes:jpg,jpeg,png,gif|max:2048',
            'genre' => 'required|array',
            'genre.*' => 'exists:genres,id'
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

        $notes = $request->input('notes');
        if (empty($notes)) {
            $notes = 'No notes provided';
        }
        $book = Book::create([
            'title' => $request->input('title'),
            'author_id' => $author_id,
            'type' => $request->input('type'),
            'language' => $request->input('language'),
            'notes' => $notes,
            'user_id' => auth()->id()
        ]);

        Log::info('Book created successfully', ['book_id' => $book->id]);


        // Attach genres if provided
        if ($request->has('genre')) {
            $book->genres()->attach($request->input('genre'));
        }


        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            // Save the file
            $path = $file->store('files', 'public'); // Correctly stores in 'storage/app/public/files'

            Log::info('Attempting to save file at:', ['path' => $path]);

            $fileModel = new File([
                'book_id' => $book->id,
                'file_name' => $filename,
                'file_path' => $path,
            ]);
            $fileModel->save();

            Log::info('File uploaded and saved', ['file_id' => $fileModel->id]);
        }


        return redirect()->route('books.index')->with('success', 'Book "' . $book->title . '" added successfully');
    }

    public function show($id): View|Factory|Application
    {
        $book = auth()->user()->books()->where('id', $id)->first();

        if (!$book) {
            Log::warning("Book with {$id} not found");
            return view('show', ['error' => "Book with id {$id} not found"]);
        }

        return view('show', ['book' => $book]);
    }
}


