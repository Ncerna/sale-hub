<?php
namespace Infrastructure\Framework\Middleware;

use Closure;

class AuthenticateMiddleware
{
    public function handle($request, Closure $next)
    {
        // lógica de autenticación
        return $next($request);
    }
}
