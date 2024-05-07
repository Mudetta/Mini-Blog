<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PostsController;



// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

route::post('register', [UsersController::class, 'register']);
route::post('login', [UsersController::class, 'login']);


Route::middleware('auth:api')->group(function (){
    Route::get('userInfo', [UsersController::class, 'userInfo']);
    Route::get('posts', [PostsController::class, 'index']);
    Route::post('posts/create', [PostsController::class, 'store']);
    Route::get('posts/show', [PostsController::class, 'show']);
    Route::put('posts/update', [PostsController::class, 'update']);
    
});