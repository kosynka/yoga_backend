<?php

use App\Http\Controllers\Api\v1\AssignmentController;
use App\Http\Controllers\Api\v1\DictionaryController;
use App\Http\Controllers\Api\v1\AffiliateController;
use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\SupportController;
use App\Http\Controllers\Api\v1\LessonController;
use App\Http\Controllers\Api\v1\TypeController;
use App\Http\Controllers\Api\v1\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->middleware('log')->group(function () {
    Route::get('cities', [DictionaryController::class, 'cities']);

    Route::post('/feedback', [SupportController::class, 'send']);

    Route::controller(AuthController::class)->group(function () {
        Route::post('/login', 'login');
        Route::post('/register', 'register');
        Route::post('/sendverify', 'sendOtp');
        Route::post('/verify', 'verifyOtp');
        Route::post('/logout', 'logout')->middleware('auth:sanctum');
    });

    Route::group(['middleware' => ['auth:api-user', 'phone.verified']], function() {
        Route::group(['prefix' => 'users', 'controller' => UserController::class], function () {
            Route::get('/{id}', 'show');
            Route::put('/{id}', 'update');
            Route::post('/update-token', 'updateToken');
            Route::delete('/{id}', 'delete');
        });

        Route::group(['prefix' => 'affiliates', 'controller' => AffiliateController::class], function () {
            Route::get('/', 'index');
            Route::get('/{id}', 'show');
        });

        Route::group(['prefix' => 'types', 'controller' => TypeController::class], function () {
            Route::get('/', 'index');
            Route::get('/{id}', 'show');
            Route::put('/{id}', 'update');
            Route::delete('/{id}', 'delete');
        });

        Route::group(['prefix' => 'assignments', 'controller' => AssignmentController::class], function () {
            Route::get('/', 'index');
            Route::post('/', 'create');
            Route::get('/{id}', 'show');
            Route::put('/{id}', 'update');
            Route::delete('/{id}', 'delete');
        });

        Route::group(['prefix' => 'lessons', 'controller' => LessonController::class], function () {
            Route::get('/', 'index');
            Route::post('/', 'create');
            Route::get('/{id}', 'show');
            Route::put('/{id}', 'update');
            Route::delete('/{id}', 'delete');
        });
    });
});
