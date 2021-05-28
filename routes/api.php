<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Auth\LoginUserController;
use App\Http\Controllers\Api\Auth\LogoutUserController;
use App\Http\Controllers\Api\Auth\LoginClientController;
use App\Http\Controllers\Api\Auth\LogoutClientController;
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


Route::post('client/login', [LoginClientController::class,'client']);

Route::post('client/code', [LoginClientController::class,'verification_code']);

Route::post('client/logout', [LogoutClientController::class,'logout'])->middleware('auth:api_client');

Route::post('user/login', [LoginUserController::class,'user']);

Route::post('user/logout', [LogoutUserController::class,'logout'])->middleware('auth:api_user');
