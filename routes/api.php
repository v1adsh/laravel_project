<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use App\Http\Requests\UserLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

Route::middleware('auth:sanctum')->get('user', function (UserLoginRequest $request) {
    return response()->json(['login' => $request->user()->login]);
});

Route::group(['middleware' => ['role:admin']], function () {
    Route::get('test', function () {
        return view('test');
    });
});

Route::post('auth', [AuthController::class, 'auth']);
Route::post('authStore', [AuthController::class, 'store']);
Route::get('authLogout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::get('application/{id}', [ApplicationController::class, 'showById']);
Route::get('application', [ApplicationController::class, 'show']);
Route::post('applicationStore', [ApplicationController::class, 'store']);
Route::post('applicationDelete', [ApplicationController::class, 'delete']);

Route::post('userDelete/{user}', [UserController::class, 'delete']);
Route::post('userStore', [UserController::class, 'store']);

Route::post('review', [ReviewController::class, 'show']);
Route::post('reviewCreate', [ReviewController::class, 'create']);


