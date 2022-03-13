<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
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

Route::group([
    'middleware' => 'guest',
    'prefix' => 'auth',
], function () {
    Route::post('/register', [\Modules\Auth\Http\Controllers\Api\RegisterController::class, 'register']);
    Route::post('/login', [\Modules\Auth\Http\Controllers\Api\LoginController::class, 'login']);
});

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return response()->json(['status' => "Email verified!"], 200);
})->middleware(['auth:sanctum', 'signed'])->name('verification.verify');
