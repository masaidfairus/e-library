<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HallController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\isAdmin;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index']);
Route::get('/about', function () {
    return view('about', ['title' => 'About']);
});

Route::get('/hall', [HallController::class, 'index']);
Route::get('/hall/book/{book:slug}', [HallController::class, 'singleBook']);
Route::get('/hall/author/{author:slug}', [HallController::class, 'bookAuthor']);
Route::get('/hall/category/{category:slug}', [HallController::class, 'bookCategory']);

Route::get('/login', [LoginController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);

Route::get('/registration', [LoginController::class, 'registration'])->middleware('guest');
Route::post('/registration', [LoginController::class, 'store']);

Route::post('/logout', [LoginController::class, 'logout']);

Route::post('/borrow', [BorrowController::class, 'store']);

Route::prefix('dashboard')->middleware(['auth', 'isAdmin'])->group(function () {

    Route::get('/', function () {
        return view('dashboard.dashboard', ['title' => 'Dashboard']);
    });

    Route::get('/category', [CategoryController::class, 'index']);
    Route::get('/category/create', [CategoryController::class, 'create']);
    Route::post('/category', [CategoryController::class, 'store']);
    Route::get('/category/{category:slug}/edit', [CategoryController::class, 'edit']);
    Route::put('/category/{category:slug}', [CategoryController::class, 'update']);
    Route::delete('/category/{category:slug}', [CategoryController::class, 'destroy']);

    Route::resource('author', AuthorController::class);
    Route::resource('user', UserController::class);
    Route::resource('book', BookController::class);
});