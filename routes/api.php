<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Infrastructure\Framework\Controller\ProductController;

Route::get('/hello', function () {
    return response()->json(['message' => 'api-Hello World!']);
});

Route::prefix('products')->group(function() {
    Route::get('/', [ProductController::class, 'index']);
    Route::post('/', [ProductController::class, 'store']);
    Route::get('/{id}', [ProductController::class, 'show']);
    Route::put('/{id}', [ProductController::class, 'update']);
    Route::delete('/{id}', [ProductController::class, 'destroy']);
});
