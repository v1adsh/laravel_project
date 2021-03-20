<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('auth', [AuthController::class, 'auth']);
Route::post('authStore', [AuthController::class, 'store']);
Route::get('authLogout', [AuthController::class, 'logout']);

Route::get('application/{id}', [ApplicationController::class, 'showById']);
Route::get('application', [ApplicationController::class, 'show']);
Route::post('application', [ApplicationController::class, 'store']);
Route::post('application', [ApplicationController::class, 'delete']);

Route::post('userStore', [UserController::class, 'store']);
Route::post('userDelete/{user}', [UserController::class, 'delete']);

Route::post('review', [ReviewController::class, 'show']);
Route::post('review', [ReviewController::class, 'create']);

