<?php
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Infrastructure\Framework\Middleware\VerifySignature;
use Infrastructure\Framework\Middleware\IdentifyTenant;
use Infrastructure\Framework\Middleware\JsonResponse;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        api: __DIR__.'/../routes/api.php',
    )->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            //'signature' => VerifySignature::class,
           // 'x-tenant' => IdentifyTenant::class,
        ]);

        
    // Middleware global, se ejecutará en cada request
          $middleware->append(IdentifyTenant::class);
       // $middleware->append(VerifySignature::class);
         $middleware->append(JsonResponse::class);
    })
  
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->renderable(function (Throwable $e, $request) {
        if ($request->expectsJson()) {
            $statusCode = method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500;

            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'code' => $statusCode
            ], $statusCode);
        }
    });
    })->create();
