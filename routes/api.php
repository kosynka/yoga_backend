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

Route::group(['prefix' => 'v1', 'middleware' => ['log']], function () {
    Route::get('cities', [DictionaryController::class, 'cities']);

    Route::post('/feedback', [SupportController::class, 'send']);

    Route::group(['controller' => AuthController::class], function () {
        Route::post('/login', 'login');
        Route::post('/register', 'register');
        Route::post('/sendverify', 'sendverify');
        Route::post('/verify', 'verify');
        Route::post('/logout', 'logout')->middleware('auth:sanctum');
    });

    Route::group(['middleware' => ['auth:api-user']], function() {
        Route::group(['prefix' => 'users', 'controller' => UserController::class], function () {
            Route::get('/', 'index')->withoutMiddleware('auth:api-user');
            Route::post('/', 'update');
            Route::put('/update-token', 'updateToken');
            Route::delete('/', 'destroy');
            Route::get('/profile', 'profile');
            Route::get('/{id}', 'show')->withoutMiddleware('auth:api-user');
        });

        Route::group(['prefix' => 'affiliates', 'controller' => AffiliateController::class], function () {
            Route::get('/', 'index')->withoutMiddleware('auth:api-user');
            Route::get('/my', 'showFavorite')->middleware('check.role:user');
            Route::get('/{id}', 'show')->withoutMiddleware('auth:api-user');
            Route::put('/{id}/favorite', 'like')->middleware('check.role:user');

        });

        Route::resource('types', TypeController::class)->only([
            'index', 'show'
        ])->withoutMiddleware('auth:api-user');

        Route::group(['prefix' => 'assignments', 'controller' => AssignmentController::class], function () {
            Route::get('/', 'index');
            Route::post('/', 'store')->middleware('check.role:user');
            Route::get('/{id}', 'show');
            Route::put('/{id}', 'update')->middleware('check.role:user');
            Route::delete('/{id}', 'destroy')->middleware('check.role:user');
        });

        Route::group(['prefix' => 'lessons', 'controller' => LessonController::class], function () {
            Route::get('/', 'index')->withoutMiddleware('auth:api-user');
            Route::post('/', 'store')->middleware('check.role:instructor');
            Route::get('/{id}', 'show')->withoutMiddleware('auth:api-user');
            Route::put('/{id}', 'update')->middleware('check.role:instructor');
            Route::delete('/{id}', 'destroy')->middleware('check.role:instructor');
        });
    });
});
