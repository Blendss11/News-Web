<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// login
Route::post('login', [\App\Http\Controllers\API\AuthController::class, 'login']);
// logout

// register
Route::post('register', [\App\Http\Controllers\API\AuthController::class, 'register']);

Route::post('logout', [\App\Http\Controllers\API\AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::post('update-password', [\App\Http\Controllers\API\AuthController::class, 'updatePassword'])->middleware('auth:sanctum');




// get
Route::get('getAllUser', [\App\Http\Controllers\API\UserController::class, 'getAlluser']);

Route::get('getUserById/{id}', [\App\Http\Controllers\API\UserController::class, 'getUserById']);


// category
Route::get('category', [\App\Http\Controllers\API\CategoryController::class, 'index']);

Route::get('category-show/{id}', [\App\Http\Controllers\API\CategoryController::class, 'show']);

Route::post('create-category', [\App\Http\Controllers\API\CategoryController::class, 'create'])->middleware('auth:sanctum');

Route::delete('delete-category/{id}', [\App\Http\Controllers\API\CategoryController::class, 'destroy'])->middleware('auth:sanctum');

// slider
Route::delete('delete-slider/{id}', [\App\Http\Controllers\API\SliderController::class, 'destroy'])->middleware('auth:sanctum');

Route::post('create-slider', [\App\Http\Controllers\API\SliderController::class, 'create'])->middleware('auth:sanctum');

Route::get('slider', [\App\Http\Controllers\API\SliderController::class, 'index']);


// news

Route::get('news', [\App\Http\Controllers\API\NewsController::class, 'index']);

Route::get('news-show/{id}', [\App\Http\Controllers\API\NewsController::class, 'show']);