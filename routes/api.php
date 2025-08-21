<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Infrastructure\Framework\Controller\ProductController;

use App\Infrastructure\Framework\Controller\CategoryController;

Route::get('/hello', function () {
    return response()->json(['message' => 'api-Hello World!']);
});

Route::prefix('products')->group(function() {
    Route::get('/', [ProductController::class, 'list']);
    Route::post('/', [ProductController::class, 'store']);
    Route::get('/{id}', [ProductController::class, 'show']);
    Route::put('/{id}', [ProductController::class, 'update']);
    Route::delete('/{id}', [ProductController::class, 'destroy']);
});


Route::prefix('categories')->group(function () {
    Route::post('/', [CategoryController::class, 'store']);
    Route::get('/', [CategoryController::class, 'list']);
    Route::get('/{id}', [CategoryController::class, 'show']);
    Route::put('/{id}', [CategoryController::class, 'update']);
    Route::delete('/{id}', [CategoryController::class, 'destroy']);
});
