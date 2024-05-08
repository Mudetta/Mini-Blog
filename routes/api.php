<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\RepliesController;

Route::post('/register', [UsersController::class, 'register'])->name("register");
Route::post('/login', [UsersController::class, 'login'])->name("login");

Route::middleware('auth:api')->group(function () {
    Route::get('/userInfo', [UsersController::class, 'userInfo'])->name("userInfo");
    Route::resource('posts', PostsController::class);
    Route::resource('comments', CommentsController::class);
    Route::resource('replies', RepliesController::class);
});
