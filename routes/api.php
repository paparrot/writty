<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ConversationController;
use App\Http\Controllers\API\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::post('auth/logout', [AuthController::class, 'logout'])
        ->name('api.logout');
    Route::get('chat', [ConversationController::class, 'list'])
        ->name('api.chat.list');
    Route::get('chat/search/{user:nickname}', [ConversationController::class, 'search'])
        ->name('api.chat.search');
    Route::get('chat/{conversation}', [ConversationController::class, 'show'])
        ->name('api.chat.show');

    Route::middleware('verified')->group(function () {
        Route::post('chat/{conversation}', [ConversationController::class, 'store'])
            ->name('api.chat.store');
    });
});

Route::post('auth/login', [AuthController::class, 'login']);
Route::post('auth/register', [AuthController::class, 'register']);

Route::get('posts', [PostController::class, 'list'])
    ->name('api.posts.list');
Route::get('posts/{post}', [PostController::class, 'show'])
    ->name('api.posts.show');
