<?php
namespace Infrastructure\ServiceImplementations;
use Illuminate\Http\Request;
use Spatie\Multitenancy\TenantFinder\TenantFinder;
use Spatie\Multitenancy\Contracts\IsTenant;
use Infrastructure\Persistence\Repository\TenantRepository;
class ApiHeaderTenantFinder extends TenantFinder
{
    protected TenantRepository $tenantRepository;
    public function __construct(TenantRepository $tenantRepository)
    {
        $this->tenantRepository = $tenantRepository;
    }
    public function findForRequest(Request $request): ?IsTenant
    {
        $tenantIdentifier = $request->header('X-Tenant');
        if (!$tenantIdentifier) {
            return null;
        }
        return $this->tenantRepository->find($tenantIdentifier);
    }
}