<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group([
    'middleware' => 'guest',
    'prefix' => 'auth'
], function () {
    Route::get('/login', [\Modules\Auth\Http\Controllers\Web\LoginController::class, 'index'])->name('login');
    Route::post('/login', [\Modules\Auth\Http\Controllers\Web\LoginController::class, 'login']);

    Route::get('/register', [\Modules\Auth\Http\Controllers\Web\RegisterController::class, 'index'])->name('register');
    Route::post('/register', [\Modules\Auth\Http\Controllers\Web\RegisterController::class, 'register']);

    Route::get('/forgot-password', [\Modules\Auth\Http\Controllers\Web\ForgotPasswordController::class, 'index'])->name('password.request');
    Route::post('/forgot-password', [\Modules\Auth\Http\Controllers\Web\ForgotPasswordController::class, 'requestLink'])->name('password.email');

    Route::get('/reset-password/{token}', [\Modules\Auth\Http\Controllers\Web\ResetPasswordController::class, 'form'])->name('password.reset');
    Route::post('/reset-password', [\Modules\Auth\Http\Controllers\Web\ResetPasswordController::class, 'reset'])->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/email/verify', [\Modules\Auth\Http\Controllers\Web\VerificationController::class, 'notice'])->name('verification.notice')->withoutMiddleware('auth');
    Route::get('/email/verify/{id}/{hash}', [\Modules\Auth\Http\Controllers\Web\VerificationController::class, 'verify'])->name('verification.verify')->middleware('signed');
    Route::post('/email/verification-notification', [\Modules\Auth\Http\Controllers\Web\VerificationController::class, 'resend'])->name('verification.send')->middleware('throttle:6,1');
    Route::get('/logout', [\Modules\Auth\Http\Controllers\Web\LogoutController::class, 'logout'])->name('logout');
});
