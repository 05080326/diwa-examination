<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Middleware\IsTeacher;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AuthController::class, 'dashboard']);
    Route::get('/books', [BookController::class, 'index']);

    Route::get('/books/assignments', [BookController::class, 'assignments']);

    Route::middleware(IsTeacher::class)->group(function () {
        // Create Books
        Route::get('/books/create', [BookController::class, 'create']);
        Route::post('/books', [BookController::class, 'store']);

        // Assign Books
        Route::get('/books/assign', [BookController::class, 'assign']);
        Route::post('/books/assign', [BookController::class, 'assignBook']);
        Route::delete('/books/unassign/{id}', [BookController::class, 'unassignBook']);
    });
});
