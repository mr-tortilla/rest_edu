<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\ChannelController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReceiptController;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

//Route::apiResources([
////    'authors' => AuthorController::class,
////    'posts' => PostController::class,
//    'channels' => ChannelController::class
//]);

//Route::prefix('api')->group(function () {
Route::controller(ChannelController::class)->prefix('channels')
    ->group(function () {
        Route::post('create', 'store');
        Route::post('delete/{id}', 'destroy');
        Route::post('update/{id}', 'update');
        Route::get('', 'index');
        Route::get('{id}', 'show');
    });
Route::controller(PostController::class)->prefix('posts')
    ->group(function () {
        Route::post('create', 'store');
        Route::post('delete/{id}', 'destroy');
        Route::post('update/{id}', 'update');
        Route::get('', 'index');
        Route::get('{id}', 'show');
    });
Route::controller(AuthorController::class)->prefix('authors')
    ->group(function () {
        Route::post('create', 'store');
        Route::post('delete/{id}', 'destroy');
        Route::post('update/{id}', 'update');
        Route::get('', 'index');
        Route::get('{id}', 'show');
    });
Route::controller(ReceiptController::class)->prefix('receipt')
    ->group(function () {
        Route::get('create', 'create');
        Route::get('create_bg', 'create_bg');
    });
//    Route::put('/users/{id}', [UserController::class, 'update']);
//});

//Route::prefix('/author')->group(function () {
//    Route::get('/paginate/{size}/{page?}', 'AuthorController@paginate');
//});
//
//Route::prefix('/post')->group(function () {
//    Route::get('/paginate/{size}/{page?}', 'PostController@paginate');
//});
//
//Route::prefix('/channel')->group(function () {
//    Route::get('/paginate/{size}/{page?}', 'ChannelController@paginate');
//});
