<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ActionLogController;


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('user/login',[AuthController::class,'login']);
Route::post('user/register',[AuthController::class,'register']);
Route::get('category',function(){
  return response()->json('This is categoty');
})->middleware('auth:sanctum'); //middleware means you need token

//post
Route::get('allPost',[PostController::class,'allPost']);
Route::post('post/search',[PostController::class,'postSearch']);
Route::post('post/detail',[PostController::class,'postDetail']);

//category
Route::get('allCategory',[CategoryController::class,'getAllCategory']);
Route::post('category/search',[CategoryController::class,'categorySearch']);

//action log
Route::post('post/actionLog',[ActionLogController::class,'setActionLog']);
