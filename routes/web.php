<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\WelcomeController;
use App\Models\Greeting;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('home');
//});
Route::get('/welcome', function () {
    return view('welcome');
});
//Route::get('/user/{name}', function ($name) {
//    return "Hello $name";
//});

// Route::method('url', [controller::class, 'name-of-function-in-controller']) -> name('name-of-route');

Route::get('/', [BookController::class, 'index']) -> name('index');
Route::post('/create', [BookController::class, 'store']) -> name('books.store');
Route::get('/create', [BookController::class, 'addBook']) -> name('books.create');
Route::get('/books', [BookController::class, 'getBooks']) -> name('books.index');
Route::get('/books/{id}', [BookController::class, 'show']) -> name('books.show');



//Route::get('/csrf-token', function () {
//    return csrf_token(); // Returnerer token som en streng
//});


//From tutorials
Route::get('/hello',[WelcomeController::class, 'hello']);
Route::get('create-greeting', function () {
    $greeting = new Greeting;
    $greeting->body = 'Hello, from your database';
    $greeting->save();
});
Route::get('first-greeting', function () {
    return Greeting::first() -> body;
});
