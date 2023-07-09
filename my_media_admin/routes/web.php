<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TrendPostController;
use App\Models\Category;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {

    //admin
    Route::get('/dashboard', [ProfileController::class, 'index'])->name('dashboard');
    Route::get('admin/changePassword', [ProfileController::class, 'changePasswordPage'])->name('admin#changePassword');
    Route::post('admin/update', [ProfileController::class, 'updateDetails'])->name('admin#update');
    ROute::post('admin/change', [ProfileController::class, 'changePassword'])->name('admin#change');

    //admin list
    Route::get('admin/list', [ListController::class, 'index'])->name('admin#list');
    Route::get('admin/delete/{id}', [ListController::class, 'deleteAccount'])->name('admin#delete');
    Route::post('admin/list/search', [ListController::class, 'searchList'])->name('admin#searchList');

    //category
    Route::get('category', [CategoryController::class, 'index'])->name('admin#category');
    Route::post('category/create', [CategoryController::class, 'createCategory'])->name('admin#categoryCreate');
    Route::post('category/search', [CategoryController::class, 'searchCategory'])->name('category#search');
    Route::get('category/edit/{id}', [CategoryController::class, 'editCategoryPage'])->name('category#editPage');
    Route::post('category/edit', [CategoryController::class, 'edit'])->name('category#edit');
    Route::get('category/delete/{id}', [CategoryController::class, 'deleteCategory'])->name('category#delete');

    //post
    Route::get('post', [PostController::class, 'index'])->name('admin#post');
    Route::post('post/create', [PostController::class, 'createPost'])->name('post#create');
    Route::post('post/search', [PostController::class, 'searchPost'])->name('post#search');
    Route::get('post/editPage/{id}', [PostController::class, 'editPostPage'])->name('post#editPage');
    Route::post('post/edit/{id}', [PostController::class, 'edit'])->name('post#edit');
    Route::get('post/delete/{id}', [PostController::class, 'delete'])->name('post#delete');

    //trend post
    Route::get('post/trend', [TrendPostController::class, 'index'])->name('admin#trendPost');
    Route::get('post/trend/details/{id}', [TrendPostController::class, 'details'])->name('admin#trendPostDetails');
});
