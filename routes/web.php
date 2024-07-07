<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ThoughtController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::post('/thought', [ThoughtController::class, 'store'])->name('thought.create');

Route::get('/profile', [ProfileController::class, 'index']);
