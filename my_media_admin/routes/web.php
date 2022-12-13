<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TrendPostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('admin.profile.index');
    // })->name('dashboard');

    //admin
    Route::get('dashboard',[ProfileController::class,'index'])->name('dashboard');
    Route::post('admin/update',[ProfileController::class,'updateAdminAccount'])->name('admin#update');
    Route::get('admin/changePassword',[ProfileController::class,'directChangePassword'])->name('admin#directChangePassword');
    Route::post('admin/changePassword',[ProfileController::class,'changePassword'])->name('admin#changePassword');
    //adminList
    Route::get('admin/list',[ListController::class,'index'])->name('admin#list');
    Route::get('admin/delete/{id}',[ListController::class,'deleteAccount'])->name('admin#Accdelete');
    Route::post('admin/list',[ListController::class,'adminListSearch'])->name('admin#ListSearch');
    //category
    Route::get('category',[CategoryController::class,'index'])->name('admin#category');
    Route::post('category',[CategoryController::class,'createCategory'])->name('admin#categoryCreate');
    Route::post('category/search',[CategoryController::class,'searchCategory'])->name('admin#searchCategory');
    Route::get('category/delete/{id}',[CategoryController::class,'deleteCategory'])->name('admin#deleteCategory');
    Route::get('category/editPage/{id}',[CategoryController::class,'editCategory'])->name('admin#editCategory');
    Route::post('category/update/{id}',[CategoryController::class,'updateCategory'])->name('admin#updateCategory');
    //post
    Route::get('post',[PostController::class,'index'])->name('admin#post');
    Route::post('admin/createPost',[PostController::class,'createPost'])->name('admin#createPost');
    Route::get('admin/deletePost/{id}',[PostController::class,'deletePost'])->name('admin#deletlePost');
    Route::get('admin/updatePage/{id}',[PostController::class,'updatePage'])->name('admin#updatePage');
    Route::post('admin/updatePost/{id}',[PostController::class,'updatePost'])->name('admin#updatePost');
    //trend post
    Route::get('trendpost',[TrendPostController::class,'index'])->name('admin#trendPost');
    Route::get('trendpost/detail/{id}',[TrendPostController::class,'trendPostDetails'])->name('admin#trendPostDetail');
});
