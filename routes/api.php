<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;


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

// mobile

Route::get('check_user', [UserController::class, 'check_user']);
Route::post('register_user', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'mobile_login']);
Route::post('update_user/{id}', [UserController::class, 'update_user'])->middleware('auth:sanctum');
Route::get('get_user', [UserController::class, 'get_user'])->middleware('auth:sanctum');
Route::get('get_user_one/{id}', [UserController::class, 'get_user_one'])->middleware('auth:sanctum');
Route::get('get_all_user', [UserController::class, 'get_all_user'])->middleware('auth:sanctum');
Route::get('user/logout', [UserController::class, 'revoke'])->middleware('auth:sanctum');
Route::delete('user/delete/{id}', [UserController::class, 'delete'])->middleware('auth:sanctum');
// Route::post('user/pay', [MobileUserController::class, 'user_pay'])->middleware('auth:sanctum');
// Route::post('user/user_get_pay', [MobileUserController::class, 'user_get_pay'])->middleware('auth:sanctum');

