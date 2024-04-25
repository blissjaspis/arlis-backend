<?php

use App\Http\Controllers\ApiController\InformationController;
use App\Http\Controllers\ApiController\LoginController;
use App\Http\Controllers\ApiController\MemberController;
use App\Http\Controllers\ApiController\OrderController;
use App\Http\Controllers\ApiController\RegisterController;
use App\Http\Controllers\ApiController\ServiceController;
use App\Http\Controllers\ApiController\UpController;
use App\Http\Controllers\ApiController\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/up', [UpController::class, 'status']);
Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth:user-api');

Route::group(['middleware' => 'auth:user-api'], function(){
    Route::apiResources([
        'user' => UserController::class,
        'information' => InformationController::class,
        'service' => ServiceController::class,
        'order' => OrderController::class,
        'member' => MemberController::class,
    ]);
});
