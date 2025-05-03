<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;

use App\Http\Controllers\DishController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ContentController;
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

    Route::middleware(['auth:sanctum', 'language'])->group(function () {
        Route::apiResource('categories', CategoryController::class);
        Route::apiResource('dishes', DishController::class);
    });

    Route::middleware(['language'])->group(function () {
        Route::apiResource('categories', CategoryController::class);
        Route::apiResource('dishes', DishController::class);
    });


    Route::get('just-categories', [CategoryController::class, 'getCategory']);

    
    Route::middleware(['admin'])->group(function () {
        Route::post('/photo/upload', [PhotoController::class, 'upload']);
        Route::delete('/photo/{filename}', [PhotoController::class, 'delete']);
        Route::post('/approve-order/{order}', [OrderController::class, 'approveOrder']);
        Route::post('/deny-order/{order}', [OrderController::class, 'denyOrder']);
        Route::post('/logout', [AuthController::class, 'logout']);

    
    });


    Route::apiResource('orders', OrderController::class); 
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/check-auth', [AuthController::class, 'checkAuth']);



    Route::middleware(['language'])->group(function () {
        Route::get('/about', [ContentController::class, 'about']);
        Route::get('/menu', [ContentController::class, 'menu']); 
    });


