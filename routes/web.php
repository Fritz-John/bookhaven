<?php

use App\Http\Controllers\BooksController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/' ,[BooksController::class, 'index'])->name('homepage');
