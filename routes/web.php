<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\FollowerControlor;
use App\Http\Controllers\ThoughtController;
use App\Http\Controllers\ThoughtLikeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use Illuminate\Support\Facades\Route;

// Initial code
// Route::group(['prefix' => 'thoughts/', 'as' => 'thoughts.'], function () {

//     Route::get('{thought}', [ThoughtController::class, 'show'])->name('show');

//     Route::group(['middleware' => ['auth']], function () {
//         Route::post('', [ThoughtController::class, 'store'])->name('store');

//         Route::get('{thought}/edit', [ThoughtController::class, 'edit'])->name('edit');

//         Route::put('{thought}', [ThoughtController::class, 'update'])->name('update');

//         Route::delete('{thought}', [ThoughtController::class, 'destroy'])->name('destroy');

//         Route::post('{thought}/comments', [CommentController::class, 'store'])->name('comments.store');
//     });
// });

// Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Terms
Route::get('/terms', function () {
    return view('terms');
})->name('terms');

// Thoughts
// These resource creates the routes for the 7 common routes except index create and show with the middleware auth
Route::resource('thoughts', ThoughtController::class)->except(['index', 'create', 'show'])->middleware(['auth']);

// These resource creates the show route
Route::resource('thoughts', ThoughtController::class)->only(['show']);

// Comments
// These resource creates the store route for comments
Route::resource('thoughts.comments', CommentController::class)->only(['store'])->middleware(['auth']);

// Register
Route::get('/register', [AuthController::class, 'register'])->name('register');

Route::post('/register', [AuthController::class, 'store']);

// Login
Route::get('/login', [AuthController::class, 'login'])->name('login');

Route::post('/login', [AuthController::class, 'authenticate']);

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Profile
Route::get('profile', [UserController::class, 'profile'])->name('profile')->middleware(['auth']);

Route::resource('users', UserController::class)->only(['edit', 'update'])->middleware(['auth']);

Route::resource('users', UserController::class)->only(['show']);

// Follow
Route::post('users/{user}/follow', [FollowerControlor::class, 'follow'])->middleware('auth')->name('users.follow');

// Unfollow
Route::post('users/{user}/unfollow', [FollowerControlor::class, 'unfollow'])->middleware('auth')->name('users.unfollow');

// Like
Route::post('thoughts/{thought}/like', [ThoughtLikeController::class, 'like'])->middleware('auth')->name('thoughts.like');

// Unlike
Route::post('thoughts/{thought}/unlike', [ThoughtLikeController::class, 'unlike'])->middleware('auth')->name('thoughts.unlike');

// Feed
Route::get('/feed', FeedController::class)->middleware('auth')->name('feed');

// Admin
Route::get('/admin', [AdminDashboardController::class, 'index'])->middleware(['auth', 'can:admin'])->name('admin.dashboard');
