<?php

use App\Http\Controllers\HallController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homepage', ['title' => 'Homepage']);
});

Route::get('/about', function () {
    return view('about', ['title' => 'About']);
});

Route::get('/hall', [HallController::class,'index']);
Route::get('/hall/book/{book:slug}', [HallController::class,'singleBook']);
Route::get('/hall/author/{author:slug}', [HallController::class, 'bookAuthor']);
Route::get('/hall/category/{category:slug}', [HallController::class, 'bookCategory']);
