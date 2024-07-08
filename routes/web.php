<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ThoughtController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::post('/thoughts', [ThoughtController::class, 'store'])->name('thoughts.store');

Route::get('/thoughts/{thought}', [ThoughtController::class, 'show'])->name('thoughts.show');

Route::get('/thoughts/{thought}/edit', [ThoughtController::class, 'edit'])->name('thoughts.edit');

Route::put('/thoughts/{thought}', [ThoughtController::class, 'update'])->name('thoughts.update');

Route::delete('/thoughts/{thought}', [ThoughtController::class, 'destroy'])->name('thoughts.destroy');

Route::post('/thoughts/{thought}/comments', [CommentController::class, 'store'])->name('thoughts.comments.store');
