<?php

use App\Http\Controllers\BookApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/books', [BookApiController::class, 'index']); // Hent alle bøger
    Route::get('/books/{id}', [BookApiController::class, 'show']); // Hent en specifik bog
    Route::post('/books', [BookApiController::class, 'store']); // Opret en ny bog
    Route::put('/books/{id}', [BookApiController::class, 'update']); // Opdater en bog
    Route::delete('/books/{id}', [BookApiController::class, 'destroy']); // Slet en bog
});
