<?php

namespace App\Http\Controllers;

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


//        session() ->put('greeting','hello');
        return view('index');
    }
    public function addBook(): View|Factory|Application
    {
        return view('create');
    }
    public function getBooks(): View|Factory|Application
    {
        $allBooks = Book::all();
        return view('books',['books' => $allBooks]);
    }
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'author' => 'required|max:255',
        ]);
        $book = Book::create($validated);

        return redirect()->route('books.index')->with('success', 'Book "' . $book->name . '" added successfully');
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


