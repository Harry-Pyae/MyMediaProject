<?php

use App\Http\Controllers\Api\ActionLogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CategoryController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('user/login', [AuthController::class, 'login']);
Route::post('user/register', [AuthController::class, 'register']);

Route::get('category', [AuthController::class, 'categoryList'])->middleware('auth:sanctum');

// API

// post
Route::get('allPostList', [PostController::class, 'getAllPost']);
Route::post('post/search', [PostController::class, 'searchPost']);
Route::post('post/details', [PostController::class, 'postDetails']);

// category
Route::get('allCategoryList', [CategoryController::class, 'getAllCategory']);
Route::post('category/select', [CategoryController::class, 'selectCategory']);

// action log
Route::post('post/actionLog', [ActionLogController::class, 'setActionLog']);
