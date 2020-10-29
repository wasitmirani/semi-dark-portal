<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\User\UserController;

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

// 'prefix' => 'admin',
// Route::group(['middleware' => 'api'], function()
// {
//     //All the routes that belongs to the group goes here
//     Route::get('/users',[UserController::class,'index']);
// });
Route::get('/get/all/users',[UserController::class,'index']);
