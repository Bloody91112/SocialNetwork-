<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\API\InitializingController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\TagController;
use App\Http\Controllers\API\PostSortController;
use App\Http\Controllers\API\PostFilterController;
use App\Http\Controllers\API\LikeController;
use App\Http\Controllers\API\CommentController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\SubscriptionController;
use App\Http\Controllers\API\DropzoneController;

Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/register', [RegisterController::class, 'register'])->name('register');

Route::group(['middleware' => 'auth:sanctum'], function(){
    Route::get('/init', InitializingController::class );
    Route::post('posts/sort', PostSortController::class);
    Route::post('posts/filter', PostFilterController::class);
    Route::resource('posts', PostController::class)->except(['create']);
    Route::resource('categories', CategoryController::class)->only(['index']);
    Route::resource('tags', TagController::class)->only(['index']);
    Route::resource('likes', LikeController::class)->only(['store', 'destroy']);
    Route::resource('subscriptions', SubscriptionController::class)->only(['store', 'destroy']);
    Route::resource('comments', CommentController::class)->only(['store', 'destroy']);
    Route::resource('users', UserController::class)->only(['index', 'show', 'update']);
    Route::post('user/image/{user}', [DropzoneController::class, 'update']);
});
