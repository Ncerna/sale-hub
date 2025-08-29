<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Src\Infrastructure\Framework\Middleware\VerifySignature;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        api: __DIR__.'/../routes/api.php',
    )->withMiddleware(function (Middleware $middleware): void {
        // Registrar middleware personalizado con alias opcional
        $middleware->alias([
            'signature' => VerifySignature::class,
        ]);

        // Agregar middleware global si lo deseas
        // $middleware->append(VerifySignature::class);
    })
  
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
