<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;

use App\Http\Controllers\DishController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ContentController;
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
    Route::middleware(['language'])->group(function () {
        Route::apiResource('categories', CategoryController::class)->only(['index', 'show']);
        Route::apiResource('dishes', DishController::class)->only(['index', 'show']);
        Route::get('/about', [ContentController::class, 'about']);
        Route::get('/menu', [ContentController::class, 'menu']);
    }); 


  


    
    Route::middleware(['auth:sanctum','admin'])->group(function () {
        Route::post('/photo/upload', [PhotoController::class, 'upload']);
        Route::delete('/photo/{filename}', [PhotoController::class, 'delete']);
        Route::post('/approve-order/{order}', [OrderController::class, 'approveOrder']);
        Route::post('/deny-order/{order}', [OrderController::class, 'denyOrder']);
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::put('/content/{type}', [ContentController::class, 'updateContent']);
        Route::apiResource('categories', CategoryController::class)->only(['destroy', 'update', 'store']);;
        Route::apiResource('dishes', DishController::class)->only(['destroy', 'update', 'store']);
        Route::get('/check-auth', [AuthController::class, 'checkAuth']);

    });


    Route::apiResource('orders', OrderController::class); 
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('just-categories', [CategoryController::class, 'getCategory']);


 