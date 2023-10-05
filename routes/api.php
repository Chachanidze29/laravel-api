<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(UserController::class)->group(function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/user', 'user');
        Route::get('/users', 'index');
        Route::post('/users', 'store');
        Route::get('/users/{user}', 'show');
        Route::put('/users/{user}', 'update');
        Route::delete('/users/{user}', 'destroy');
    });
});

Route::controller(RoleController::class)->group(function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/roles', 'index');
        Route::post('/roles', 'store');
        Route::get('/roles/{role}', 'show');
        Route::put('/roles/{role}', 'update');
        Route::delete('/roles/{role}', 'destroy');
    });
});

Route::controller(AuthController::class)->group(function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', 'logout');
    });

    Route::post('/login', 'login');
    Route::post('/register', 'register');
});

