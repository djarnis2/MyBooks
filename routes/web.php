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

Route::get('/', [BookController::class, 'index']) -> name('index');
Route::post('/books/store', [BookController::class, 'store']) -> name('books.store');
Route::get('/books/create', [BookController::class, 'create']) -> name('books.create');
Route::get('/books', [BookController::class, 'allBooks']) -> name('books.index');
Route::get('/books/{id}', [BookController::class, 'show']) -> name('books.show');
Route::get('/register', [RegisterController::class, 'create']) -> name('register.create');
Route::post('/register', [RegisterController::class, 'store']) -> name('register.store');
Route::get('/login', [LoginController::class, 'loginform']) -> name('login.index');
Route::post('/login', [LoginController::class, 'authenticate']) -> name('login.authenticate');
Route::post('/logout', [LoginController::class, 'logout']) -> name('logout');

//Route::get('/csrf-token', function () {
//    return csrf_token(); // Returnerer token som en string
//});


