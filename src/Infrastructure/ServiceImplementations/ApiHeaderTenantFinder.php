<?php
namespace Infrastructure\ServiceImplementations;
use Illuminate\Http\Request;
use Spatie\Multitenancy\TenantFinder\TenantFinder;
use Spatie\Multitenancy\Contracts\IsTenant;
use Infrastructure\Persistence\Repository\TenantRepository;
use Illuminate\Support\Facades\Log;
class ApiHeaderTenantFinder extends TenantFinder
{
    protected TenantRepository $tenantRepository;

    public function __construct(TenantRepository $tenantRepository)
    {
        $this->tenantRepository = $tenantRepository;
    }

    // La firma debe ser compatible, con retorno nullable y tipo IsTenant
    public function findForRequest(Request $request): ?IsTenant
    {
        $tenantIdentifier = $request->header('X-Tenant-Identifier');
    
Log::warning('Request headers: ', $request->headers->all());


        if (!$tenantIdentifier) {
            return null;
        }
 
        return $this->tenantRepository->find($tenantIdentifier);
    }
}