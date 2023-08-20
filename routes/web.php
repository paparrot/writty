<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PostController::class, 'feed'])
    ->name('home');
Route::get('posts/create', [PostController::class, 'create'])
    ->name('posts.create');
Route::get('posts/favourites', [PostController::class, 'favourites'])->name('posts.favourites');
Route::get('posts/following', [PostController::class, 'following'])->name('posts.following');
Route::get('posts/search', [PostController::class, 'search'])->name('posts.search');
Route::get('posts/{post}', [PostController::class, 'show'])
    ->name('posts.show');
Route::middleware('verified')->group(function () {
    Route::post('posts', [PostController::class, 'store'])
        ->name('posts.store');
    Route::post('posts/{post}/reply', [PostController::class, 'reply'])
        ->name('posts.reply');
    Route::post('posts/{post}/like', [PostController::class, 'like'])
        ->name('posts.like');
});
Route::get('posts/{post}/reply', [PostController::class, 'createReply'])
    ->name('posts.reply.create');
Route::delete('posts/{post}', [PostController::class, 'destroy'])
    ->name('posts.delete');
Route::delete('posts/{post}/like', [PostController::class, 'unlike'])->name('posts.unlike');

Route::get('email/verify', [UserController::class, 'verify'])
    ->name('verification.notice');

Route::middleware('verified')->group(function() {
    Route::post('users/{user:nickname}', [UserController::class, 'follow'])
        ->name('users.follow');
    Route::post('users/profile/{user:nickname}', [UserController::class, 'update'])
        ->name('profile.update');
});
Route::delete('users/{user:nickname}', [UserController::class, 'unfollow'])
    ->name('users.unfollow');
Route::get('users/{user:nickname}', [UserController::class, 'show'])
    ->name('profile.show');
Route::get('users/profile/edit', [UserController::class, 'edit'])
    ->name('profile.edit');
