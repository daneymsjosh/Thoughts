<?php

use App\Http\Controllers\Admin\CommentController as AdminCommentController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowerControlor;
use App\Http\Controllers\ThoughtController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ThoughtLikeController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ThoughtController as AdminThoughtController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\BookmarkController;

// Grouped routes
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

// Change language
Route::get('lang/{lang}', function ($lang) {
    app()->setLocale($lang);
    Session::put('locale', $lang);

    return redirect()->route('dashboard');
})->name('lang');

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

// When a user is logged in, he/she can't view the login or register page
Route::group(['middleware' => 'guest'], function () {
    // Register
    Route::get('/register', [AuthController::class, 'register'])->name('register');

    Route::post('/register', [AuthController::class, 'store']);

    // Login
    Route::get('/login', [AuthController::class, 'login'])->name('login');

    Route::post('/login', [AuthController::class, 'authenticate']);
});

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Profile
Route::get('profile', [UserController::class, 'profile'])->name('profile')->middleware(['auth']);

Route::resource('users', UserController::class)->only(['edit', 'update'])->middleware(['auth']);

Route::resource('users', UserController::class)->only(['show'])->middleware(['auth']);

// Follow
Route::post('users/{user}/follow', [FollowerControlor::class, 'follow'])->middleware('auth')->name('users.follow');

// Unfollow
Route::post('users/{user}/unfollow', [FollowerControlor::class, 'unfollow'])->middleware('auth')->name('users.unfollow');

// LikedThought
Route::get('/like', ThoughtLikeController::class)->middleware('auth')->name('like');

// Like
Route::post('thoughts/{thought}/like', [ThoughtLikeController::class, 'like'])->middleware('auth')->name('thoughts.like');

// Unlike
Route::post('thoughts/{thought}/unlike', [ThoughtLikeController::class, 'unlike'])->middleware('auth')->name('thoughts.unlike');

// Bookmark
Route::get('/bookmark', BookmarkController::class)->middleware('auth')->name('bookmark');

// Pin
Route::post('thoughts/{thought}/pin', [BookmarkController::class, 'pin'])->middleware('auth')->name('thoughts.pin');

// Unpin
Route::post('thoughts/{thought}/unpin', [BookmarkController::class, 'unpin'])->middleware('auth')->name('thoughts.unpin');

// Feed
Route::get('/feed', FeedController::class)->middleware('auth')->name('feed');

// Admin grouped routes
Route::middleware(['auth', 'can:admin'])->prefix('admin/')->as('admin.')->group(function () {
    Route::get('', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::resource('users', AdminUserController::class)->only(['index']);

    Route::resource('thoughts', AdminThoughtController::class)->only(['index']);

    Route::resource('comments', AdminCommentController::class)->only(['index', 'destroy']);
});
