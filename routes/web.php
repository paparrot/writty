<?php

use App\Http\Controllers\App\MessageController;
use App\Http\Controllers\App\PostController;
use App\Http\Controllers\App\UserController;
use App\Socials\TelegramController;
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
Route::middleware('auth')->group(function () {
    Route::get('email/verify', [UserController::class, 'verify'])
        ->name('verification.notice');
    Route::get('users/profile/edit', [UserController::class, 'edit'])
        ->name('profile.edit');
    Route::get('users/profile/add-email', [UserController::class, 'addEmail'])
        ->name('profile.add-email');
    Route::get('posts/favourites', [PostController::class, 'favourites'])->name('posts.favourites');
    Route::get('posts/following', [PostController::class, 'following'])->name('posts.following');
    Route::get('posts/create', [PostController::class, 'create'])
        ->name('posts.create');
    Route::get('chat/{user:nickname}', [MessageController::class, 'chat'])
        ->name('chat.show');
    Route::get('posts/{post}/reply', [PostController::class, 'createReply'])
        ->name('posts.reply.create');
});

Route::get('/', [PostController::class, 'feed'])
    ->name('home');
Route::get('posts/search', [PostController::class, 'search'])->name('posts.search');
Route::get('posts/{post}', [PostController::class, 'show'])
    ->name('posts.show');

Route::middleware(['auth', 'validate-email', 'verified'])->group(function () {
    Route::post('posts', [PostController::class, 'store'])
        ->name('posts.store');
    Route::post('posts/{post}/reply', [PostController::class, 'reply'])
        ->name('posts.reply');
    Route::post('posts/{post}/like', [PostController::class, 'like'])
        ->name('posts.like');
    Route::post('posts/{post}/repost', [PostController::class, 'repost'])
        ->name('posts.repost');
    Route::delete('posts/{post}', [PostController::class, 'destroy'])
        ->name('posts.delete');
    Route::delete('posts/{post}/like', [PostController::class, 'unlike'])
        ->name('posts.unlike');
    Route::post('chat', [MessageController::class, 'store'])
        ->name('chat.create');
    Route::post('users/{user:nickname}/follow', [UserController::class, 'follow'])
        ->name('profile.follow');
    Route::post('users/profile', [UserController::class, 'update'])
        ->name('profile.update');
    Route::delete('users/profile', [UserController::class, 'destroy'])
        ->name('profile.delete');
    Route::delete('users/{user:nickname}/follow', [UserController::class, 'unfollow'])
        ->name('profile.unfollow');
});

Route::get('users/{user:nickname}/following', [UserController::class, 'following'])
    ->name('profile.following');
Route::get('users/{user:nickname}/followers', [UserController::class, 'followers'])
    ->name('profile.followers');
Route::get('users/{user:nickname}', [UserController::class, 'show'])
    ->name('profile.show');

Route::get('auth/telegram/redirect', [TelegramController::class, 'redirect'])
    ->name('auth.telegram.redirect');
Route::get('auth/telegram/callback', [TelegramController::class, 'callback'])
    ->name('auth.telegram.callback');
