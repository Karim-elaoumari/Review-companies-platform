<?php

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\IndustryController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
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
Route::middleware('auth:api')->get('/auth_test', function (Request $request) {
    return response()->json([
        'message' => 'You are logged in',
        'user'=> new UserResource($request->user())
    ],200);
});

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout')->middleware('auth:api');
    Route::post('forgot', 'forgot');
    Route::put('refresh','refresh');
    Route::put('reset', 'reset');
    Route::post('verify-email', 'verify');
});

Route::controller(UserController::class)->group(function () {
    Route::get('user','user');
    Route::get('users','users');
    Route::get('user/{id}','showOneUser');
    Route::put('update_password','updatePassword');
    Route::put('update_user_info','updateInfo');
    Route::put('update_email','updateEmail');
    Route::put('user/update_user_role','updateUserRole');
})->middleware('auth:api');
Route::apiresource('jobs', JobController::class);
Route::apiresource('industries', IndustryController::class);
Route::apiresource('companies', CompanyController::class);
Route::controller(CompanyController::class)->group(function () {
    Route::get('companies_manager','getManagerCompanies')->middleware('auth:api');
    Route::post('delete_company/{id}','deleteCompany')->middleware('auth:api');

});
Route::apiresource('reviews', ReviewController::class);
Route::controller(ReviewController::class)->group(function (){
    Route::get('reviews_manager','getRelatedReviews')->middleware('auth:api');
    Route::post('delete_review/{id}','deleteReview')->middleware('auth:api');
});

