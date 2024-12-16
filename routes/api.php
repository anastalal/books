<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AuthController;
// use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
//group routes without csrf token   

Route::post('/register', [AuthController::class, 'register'])
    ->middleware('guest')
    ->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class])
    ->name('register');

Route::post('/login', [AuthController::class, 'login'])
    ->middleware('guest')
    ->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class])
    ->name('login');
Route::get('/books', [BookController::class, 'index']);    
Route::get('/books/{id}', [BookController::class, 'show']);   
Route::post('/books', [BookController::class, 'store'])->middleware('auth:sanctum');      
Route::put('/books/{id}', [BookController::class, 'update'])->middleware('auth:sanctum'); 
Route::delete('/books/{id}', [BookController::class, 'destroy'])->middleware('auth:sanctum'); 
