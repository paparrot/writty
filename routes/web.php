<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserProfileController;
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
Route::post('posts', [PostController::class, 'store'])
    ->name('posts.store');
Route::delete('posts/{post}', [PostController::class, 'destroy'])
    ->name('posts.delete');
Route::post('posts/{post}/like', [PostController::class, 'like'])->name('posts.like');
Route::delete('posts/{post}/like', [PostController::class, 'unlike'])->name('posts.unlike');
Route::get('posts/favourites', [PostController::class, 'favourites'])->name('posts.favourites');
Route::get('posts/following', [PostController::class, 'following'])->name('posts.following');


Route::get('users/{user:nickname}', [UserProfileController::class, 'show'])
    ->name('profile.show');
Route::post('users/profile/{user}', [UserProfileController::class, 'update'])
    ->name('profile.update');
Route::get('users/profile/edit', [UserProfileController::class, 'edit'])
    ->name('profile.edit');
