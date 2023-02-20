<?php

use App\Http\Controllers\Api\v1\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
    Route::post('/feedback', [SupportController::class, 'send']);

    Route::prefix('verification')->group(function () {
        Route::post('/sendverify', [UserController::class, 'sendOtp']);
        Route::post('/verify', [UserController::class, 'verifyOtp']);
    });


    Route::post('/forgot-password', [AuthController::class, 'sendForgot']);
    Route::post('/reset-password', [AuthController::class, 'reset']);

    Route::resource('user', PhotoController::class)->only([
        'show'
    ]);

    Route::group(['prefix' => 'user', 'middleware' => ['auth:api-user', 'phoneverified']], function () {
        Route::get('/{id}', [UserController::class, 'show']);
        Route::put('/{id}', [UserController::class, 'update']);
        Route::delete('/{id}', [UserController::class, 'delete']);
        Route::post('/update-token', [UserController::class, 'updateToken']);

        Route::get('/purchases', [PurchaseController::class, 'index']);
    });
});