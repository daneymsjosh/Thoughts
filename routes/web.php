<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ThoughtController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::post('/thoughts', [ThoughtController::class, 'store'])->name('thought.store');

Route::delete('/thoughts/{id}', [ThoughtController::class, 'destroy'])->name('thought.destroy');
