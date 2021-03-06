<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AdminController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['role:admin']], function () {
    Route::get('user', [AdminController::class, 'show'])->middleware('auth:sanctum');
    Route::post('userUpdate/{user}', [AdminController::class, 'update'])->middleware('auth:sanctum');
    Route::post('userStore', [AdminController::class, 'store'])->middleware('auth:sanctum');
    Route::post('userDelete/{user}', [AdminController::class, 'delete'])->middleware('auth:sanctum');
    Route::post('applicationUpdate/{application}', [AdminController::class, 'updateStatus'])->middleware('auth:sanctum');
    Route::post('applicationDeleteAdmin/{application}', [AdminController::class, 'deleteApplication'])->middleware('auth:sanctum');
});

Route::post('login', [AuthController::class, 'login']);
Route::post('authStore', [AuthController::class, 'store']);
Route::get('authLogout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::get('application', [ApplicationController::class, 'show'])->middleware('auth:sanctum');
Route::post('applicationStore', [ApplicationController::class, 'store'])->middleware('auth:sanctum');
Route::post('applicationDelete/{application}', [ApplicationController::class, 'delete'])->middleware('auth:sanctum');

Route::get('review', [ReviewController::class, 'showReview']);
Route::post('reviewStore', [ReviewController::class, 'store'])->middleware('auth:sanctum');
Route::post('reviewDelete/{review}', [ReviewController::class, 'deleteReview'])->middleware('auth:sanctum');
Route::post('reviewUpdate/{id}', [ReviewController::class, 'updateReview'])->middleware('auth:sanctum');

Route::post('reviewRatingStore/{review}', [ReviewController::class, 'storeEstimation'])->middleware('auth:sanctum');
Route::post('reviewRatingDelete/{reviewRating}', [ReviewController::class, 'deleteEstimation'])->middleware('auth:sanctum');
Route::get('reviewRating', [ReviewController::class, 'showReviewRating']);
