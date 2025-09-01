<?php

namespace Infrastructure\Framework\Middleware;
use Illuminate\Support\Facades\Log;
use Closure;
use Illuminate\Http\Request;
use Infrastructure\ServiceImplementations\ApiHeaderTenantFinder;
use Spatie\Multitenancy\Models\Tenant;
use Exception;

class IdentifyTenant
{
    protected ApiHeaderTenantFinder $tenantFinder;

    public function __construct(ApiHeaderTenantFinder $tenantFinder)
    {
        $this->tenantFinder = $tenantFinder;
    }

    public function handle(Request $request, Closure $next)
    {
        $tenant = $this->tenantFinder->findForRequest($request);

        if (!$tenant) {
            throw new Exception('Tenant no encontrado', 401);
        }
         if (!($tenant instanceof Tenant)) {
         throw new Exception('El tenant no es del tipo esperado');
         }

        Tenant::forgetCurrent();
        $tenant->makeCurrent();

        return $next($request);
    }
}

