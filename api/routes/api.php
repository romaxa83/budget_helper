<?php

use App\Http\Controllers\Api\V1;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api;

Route::get('info', Api\InfoController::class)
    ->name('api.info');

// Auth
Route::post('register', [V1\Auth\AuthController::class, 'register'])->name('api.v1.auth.register');
Route::post('login', [V1\Auth\AuthController::class, 'login'])->name('api.v1.auth.login');

// Profile
Route::group(['middleware' => ['auth:api']],function (){
    Route::get('user', [V1\Auth\AuthController::class, 'user'])->name('api.v1.auth.user');
    Route::post('logout', [V1\Auth\AuthController::class, 'logout'])->name('api.v1.auth.logout');

    Route::prefix('profile')->group(function(){
        // Tag
        Route::get('tags', [V1\Profile\TagController::class, 'index'])
            ->name('api.v1.profile.tag.index');
        Route::get('tags/{id}', [V1\Profile\TagController::class, 'show'])
            ->name('api.v1.profile.tag.show');
        Route::post('tags', [V1\Profile\TagController::class, 'create'])
            ->name('api.v1.profile.tag.create');
    });
});





