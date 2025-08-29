<?php
namespace Infrastructure\Framework\Middleware;
use Illuminate\Support\Facades\Log;
use Closure;
use Illuminate\Http\Request;
use Infrastructure\ServiceImplementations\ApiHeaderTenantFinder;
use Spatie\Multitenancy\Models\Tenant;

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
          

            return response()->json(['message' => 'Tenant no encontrado'], 401);
        }

        $currentTenant = Tenant::current();

        if ($currentTenant === null || !$tenant->isCurrent()) {
            Log::info('Cambio de tenant activo detectado.', [
                'tenant_anterior' => $currentTenant->getKey(),
                'tenant_nuevo' => $tenant->getDatabaseName(),
            ]);
            $tenant->makeCurrent();
        }

        return $next($request);
    }
}

