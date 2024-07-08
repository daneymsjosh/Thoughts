<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ThoughtController;
use Illuminate\Support\Facades\Route;

// Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Thoughts
Route::post('/thoughts', [ThoughtController::class, 'store'])->name('thoughts.store');

Route::get('/thoughts/{thought}', [ThoughtController::class, 'show'])->name('thoughts.show');

Route::get('/thoughts/{thought}/edit', [ThoughtController::class, 'edit'])->name('thoughts.edit')->middleware('auth');

Route::put('/thoughts/{thought}', [ThoughtController::class, 'update'])->name('thoughts.update')->middleware('auth');

Route::delete('/thoughts/{thought}', [ThoughtController::class, 'destroy'])->name('thoughts.destroy')->middleware('auth');

// Comments
Route::post('/thoughts/{thought}/comments', [CommentController::class, 'store'])->name('thoughts.comments.store')->middleware('auth');

// Register
Route::get('/register', [AuthController::class, 'register'])->name('register');

Route::post('/register', [AuthController::class, 'store']);

// Login
Route::get('/login', [AuthController::class, 'login'])->name('login');

Route::post('/login', [AuthController::class, 'authenticate']);

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
