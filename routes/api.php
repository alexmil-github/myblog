<?php

use Illuminate\Http\Request;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('register', [\App\Http\Controllers\UsersController::class, 'register']);
Route::post('login', [\App\Http\Controllers\UsersController::class, 'login']);

Route::post('post', [\App\Http\Controllers\PostController::class, 'store'])->middleware('auth:api');
Route::get('post', [\App\Http\Controllers\PostController::class, 'index']);
Route::get('post/{id}', [\App\Http\Controllers\PostController::class, 'show'])->middleware('auth:api');

