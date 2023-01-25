<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\Chat\MessageController;
use App\Http\Controllers\API\Chat\RoomController;
use App\Http\Controllers\API\Chat\UserRoomController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserOfflineController;
use App\Http\Controllers\UserOnlineController;
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

// Авторизация
Route::middleware('auth:sanctum')->group(function () {
    // Все МОИ посты
    Route::get('/posts/my', [PostController::class, 'allMyPosts']);
    Route::put('/user/{user}/online', [UserOnlineController::class]);
    Route::put('/user/{user}/offline', [UserOfflineController::class]);

    Route::get('/me', [AuthController::class, 'me']);
    Route::get('/logout', [AuthController::class, 'logout']);

    // Изменения профиля
    Route::post('/user/update', [UserController::class, 'update']);
    // Друзья
    Route::controller(FriendController::class)->group(function () {
        // Все друзья
        Route::get('/friends', 'all');
        // Кол-во друзей
        Route::get('/friends/count', 'countFriends');
        // Только одного друга
//        Route::get('/friends/{id}', 'index');
        // Отправить заявку в друзья
        Route::post('/friends/add', 'add');
        // Вывод заявок в друзья
        Route::get('/friends/requests', 'friendsRequests');
        // Принять заявку в друзья
        Route::get('/friends/{id}/submit', 'submitRequest');
        // Отвергнуть заявку в друзь
        Route::delete('/friends/{id}/rejected', 'rejectedRequest');
        // Удалить из друзей
        Route::delete('/friends/{id}', 'destroy');
    });

    // Категории
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/categories', 'all');
        Route::get('/categories/{id}', 'index');
        Route::post('/categories/create', 'store');
        Route::put('/categories/{id}', 'update');
        Route::delete('/categories/{id}', 'destroy');
    });

    // Добавление категории предпочтений
    Route::post('/categories/add', [UserController::class, 'addCategory']);
    // Отправить сообщение
    Route::post('/message/create', [MessageController::class,'store']);
    //Удаление сообщения
    Route::delete('/message/{id}', [MessageController::class,'destroy']);
    // Создание поста
    Route::post('/posts/create', [PostController::class, 'store']);
    // Удаление поста
    Route::delete('/posts/{id}', [PostController::class, 'destroy']);
});
Route::post('/signUp', [AuthController::class, 'signUp']);
Route::post('/signIn', [AuthController::class, 'signIn']);
// Посты
Route::controller(PostController::class)->group(function () {
    Route::get('/posts', 'all');
    // Все мои посты
    Route::get('/posts/{id}', 'index');
    Route::put('/posts/{id}', 'update');
});
// Пользователи
Route::get('/users', [UserController::class, 'all']);
Route::get('/users/{id}', [UserController::class, 'show']);
// Чат
// Для ТЕСТА
// ----------------
Route::get('/messages', [MessageController::class,'all']);
Route::get('/room/{id}/messages', [MessageController::class, 'getMessages']);
// ----------------
// Комнаты
Route::get('/rooms', [RoomController::class, 'all']);
Route::get('/rooms/{id}', [RoomController::class, 'index']);
// Участники комнаты
Route::get('/rooms/{id}/participants',[UserRoomController::class,'index']);
