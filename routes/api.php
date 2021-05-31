<?php

use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\ArticleFavoriteController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::name('api')->group(function () {
    Route::post('users/login', [UserController::class, 'login']);
    Route::get('user', [UserController::class, 'show'])->middleware(['auth:api']);
    Route::post('users', [UserController::class, 'store'])->middleware(['auth:api']);
    Route::put('users', [UserController::class, 'update'])->middleware(['auth:api']);

    Route::get('profiles/{user:username}', [ProfileController::class, 'show']);
    Route::post('profiles/{user:username}/follow', [ProfileController::class, 'store'])->middleware(['auth:api']);
    Route::delete('profiles/{user:username}/follow', [ProfileController::class, 'destroy'])->middleware(['auth:api']);

    Route::get('articles', [ArticleController::class, 'index']);
    Route::post('articles', [ArticleController::class, 'store'])->middleware(['auth:api']);
    Route::get('articles/{article:slug}', [ArticleController::class, 'show']);
    Route::put('articles/{article:slug}', [ArticleController::class, 'update'])->middleware(['auth:api']);
    Route::delete('articles/{article:slug}', [ArticleController::class, 'destroy'])->middleware(['auth:api']);
    Route::get('articles/feed', [ArticleController::class, 'index'])->middleware(['auth:api']);

    Route::post('article/{article:slug}/favorite', [ArticleFavoriteController::class, 'store'])->middleware(['auth:api']);
    Route::delete('article/{article:slug}/favorite', [ArticleFavoriteController::class, 'destroy'])->middleware(['auth:api']);

    Route::get('articles/{article:slug}/comments', [CommentController::class, 'index']);
    Route::post('articles/{article:slug}/comments', [CommentController::class, 'store'])->middleware(['auth:api']);
    Route::delete('articles/{article:slug}/comments/{comment}', [CommentController::class, 'destroy'])->middleware(['auth:api']);

    Route::get('tags', [TagController::class, 'index']);
});
