<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\PostController;

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

// Авторизация
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::get('/logout', [AuthController::class, 'logout']);

    // Друзья
    Route::controller(FriendController::class)->group(function () {
        Route::get('/friends', 'all');
        Route::get('/friends/{id}', 'index');
        Route::post('/friends/add', 'add');
        Route::delete('/friends/delete', 'delete');
    });
});
Route::post('/signUp', [AuthController::class, 'signUp']);
Route::post('/signIn', [AuthController::class, 'signIn']);

// Категории
Route::controller(CategoryController::class)->group(function () {
    Route::get('/categories', 'all');
    Route::get('/categories/{id}', 'index');
    Route::post('/categories/create', 'store');
    Route::put('/categories/{id}', 'update');
    Route::delete('/categories/{id}', 'destroy');
});

// Посты
Route::controller(PostController::class)->group(function () {
    Route::get('/posts', 'all');
    Route::get('/posts/{id}', 'index');
    Route::post('/posts/create', 'store');
    Route::put('/posts/{id}', 'update');
    Route::delete('/posts/{id}', 'destroy');
});
