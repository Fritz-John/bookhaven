<?php

use App\Http\Controllers\BooksController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/' ,[BooksController::class, 'index'])->name('homepage');

Route::get('/shop' ,[BooksController::class, 'show_all'])->name('shop');

Route::get('/book/{book_id}' ,[BooksController::class, 'show'])->name('show');
