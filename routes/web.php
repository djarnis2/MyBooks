<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

//Route::get('/', function () {
//    return view('home');
//});

//Route::get('/user/{name}', function ($name) {
//    return "Hello $name";
//});

// Route::method('url', [controller::class, 'name-of-function-in-controller']) -> name('name-of-route');

Route::middleware(['auth'])->group(function () {
    Route::get('/books', [BookController::class, 'allBooks']) -> name('books.index');
    Route::post('/books/store', [BookController::class, 'store']) -> name('books.store');
    Route::get('/books/create', [BookController::class, 'create']) -> name('books.create');
    Route::post('/logout', [LoginController::class, 'logout']) -> name('logout');
    Route::get('/books/{id}', [BookController::class, 'show']) -> name('books.show');
    Route::delete('/books/{id}', [BookController::class, 'destroy']) -> name('books.destroy');
    Route::put('/books/{id}', [BookController::class, 'update'])->name('books.update');
    Route::get('/books/{id}/edit', [BookController::class, 'edit'])->name('books.edit');



});

Route::get('/', [BookController::class, 'index']) -> name('index');
Route::get('/register', [RegisterController::class, 'create']) -> name('register.create');
Route::post('/register', [RegisterController::class, 'store']) -> name('register.store');
Route::get('/login', [LoginController::class, 'loginform']) -> name('login');
Route::post('/login', [LoginController::class, 'authenticate']) -> name('login.authenticate');

//Route::get('/csrf-token', function () {
//    return csrf_token(); // Returnerer token som en string
//});

// route for layout
Route::get('/test', function () {
    return view('test');
});


Route::get('/testl', function () {
    return view('testL');
});
