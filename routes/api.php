<?php

use App\Http\Controllers\ApiController\InformationController;
use App\Http\Controllers\ApiController\LoginController;
use App\Http\Controllers\ApiController\MemberController;
use App\Http\Controllers\ApiController\RegisterController;
use App\Http\Controllers\ApiController\ServiceController;
use App\Http\Controllers\ApiController\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('user')->middleware('auth:user-api')->group(function(){
    Route::get('/', [UserController::class, 'index']);
    Route::post('/', [UserController::class, 'store']);
    Route::get('/{user}', [UserController::class, 'show']);
    Route::put('/{user}', [UserController::class, 'update']);
    Route::delete('/{user}', [UserController::class, 'destroy']);
});

Route::prefix('information')->middleware('auth:user-api')->group(function(){
    Route::get('/', [InformationController::class, 'index']);
    Route::post('/', [InformationController::class, 'store']);
    Route::get('/{information}', [InformationController::class, 'show']);
    Route::put('/{information}', [InformationController::class, 'update']);
    Route::delete('/{information}', [InformationController::class, 'destroy']);
});

Route::prefix('service')->middleware('auth:user-api')->group(function(){
    Route::get('/', [ServiceController::class, 'index']);
    Route::post('/', [ServiceController::class, 'store']);
    Route::get('/{service}', [ServiceController::class, 'show']);
    Route::put('/{service}', [ServiceController::class, 'update']);
    Route::delete('/{service}', [ServiceController::class, 'destroy']);
});

Route::prefix('order')->middleware('auth:user-api')->group(function(){
    Route::get('/', [ServiceController::class, 'index']);
    Route::post('/', [ServiceController::class, 'store']);
    Route::get('/{service}', [ServiceController::class, 'show']);
    Route::put('/{service}', [ServiceController::class, 'update']);
    Route::delete('/{service}', [ServiceController::class, 'destroy']);
});

Route::prefix('member')->middleware('auth:user-api')->group(function(){
    Route::get('/', [MemberController::class, 'index']);
    Route::post('/', [MemberController::class, 'store']);
    Route::get('/{member}', [MemberController::class, 'show']);
    Route::put('/{member}', [MemberController::class, 'update']);
    Route::delete('/{member}', [MemberController::class, 'destroy']);
});

