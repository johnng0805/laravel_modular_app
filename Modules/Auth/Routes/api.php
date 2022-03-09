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

Route::middleware('auth:api')->get('/auth', function (Request $request) {
    return $request->user();
});

Route::group([
    'middleware' => 'guest',
    'prefix' => 'auth',
], function () {
    Route::post('/register', [\Modules\Auth\Http\Controllers\Api\RegisterController::class, 'register']);
    Route::post('/login', [\Modules\Auth\Http\Controllers\Api\LoginController::class, 'login']);
});
