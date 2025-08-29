<?php

use Illuminate\Support\Facades\Route;
use Infrastructure\Framework\Controller\UserController;
use Infrastructure\Framework\Controller\ProductController;

use Infrastructure\Framework\Controller\CategoryController;

Route::get('/hello', function () {
    return response()->json(['message' => 'api-Hello World!']);
});

Route::middleware(['x-tenant'])->group(function () {
    Route::get('/ping', fn() => response()->json(['message' => 'Hola']));
    // otras rutas...
});


Route::prefix('users')->group(function () {
    Route::post('/', [UserController::class, 'store']);    
    Route::get('/', [UserController::class, 'list']);      
    Route::get('/{id}', [UserController::class, 'show']);   
    Route::put('/{id}', [UserController::class, 'update']);
    Route::delete('/{id}', [UserController::class, 'destroy']); 
});

// Rutas protegidas con JWT, solo accesibles si el token es válido
Route::middleware(['auth:api', 'signature'])->group(function () {
    Route::get('/products', [ProductController::class, 'list']);
    Route::post('/products', [ProductController::class, 'store']);
    // etc.
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
