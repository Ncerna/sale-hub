<?php
namespace App\Exceptions;

use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class Handler extends ExceptionHandler
{
    public function render($request, Throwable $exception)
    {
        if ($request->expectsJson()) {
            $statusCode = 500;
            if ($exception instanceof HttpExceptionInterface) {
                $statusCode = $exception->getStatusCode();
            }

            return response()->json([
                'status' => false,
                'message' => $exception->getMessage() ?: 'Error inesperado',
                'code' => $exception->getCode() ?: $statusCode,
            ], $statusCode);
        }

        return parent::render($request, $exception);
    }
}
