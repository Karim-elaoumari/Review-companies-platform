<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiresource('companies', CompanyController::class);
Route::apiresource('comments', CommentController::class);
Route::apiresource('reviews', ReviewController::class);
Route::apiresource('counries', CountryController::class);
Route::apiresource('industries', IndustriesController::class);
Route::apiresource('jobs', JobController::class);
Route::apiresource('notifications', NotificationController::class);
