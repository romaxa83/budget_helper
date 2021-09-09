<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api;

Route::get('info', Api\InfoController::class)
    ->name('api.info');

// Auth
Route::post('register', [Api\V1\Auth\AuthController::class, 'register'])->name('api.v1.auth.register');
Route::post('login', [Api\V1\Auth\AuthController::class, 'login'])->name('api.v1.auth.login');

// Profile
Route::group(['middleware' => ['auth:api']],function (){
    Route::get('user', [Api\V1\Auth\AuthController::class, 'user'])->name('api.v1.auth.user');
    Route::post('logout', [Api\V1\Auth\AuthController::class, 'logout'])->name('api.v1.auth.logout');

    Route::prefix('profile')->group(function(){

    });
});





