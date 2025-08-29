<?php
namespace Infrastructure\Persistence\Repository;

use Spatie\Multitenancy\Models\Tenant;

class TenantRepository
{
    protected array $tenants = [
        ['id' => 1, 'name' => 'Cliente Uno', 'domain' => 'cliente1', 'database' => 'cliente1_db'],
        ['id' => 2, 'name' => 'Cliente Dos', 'domain' => 'cliente2', 'database' => 'cliente2_db'],
    ];

    public function all(): array
    {
        return array_map(fn($data) => $this->toTenant($data), $this->tenants);
    }

    public function find(string $idOrDomain): ?Tenant
    {
        foreach ($this->tenants as $tenantData) {
            if ($tenantData['id'] == $idOrDomain || $tenantData['domain'] === $idOrDomain) {
                return $this->toTenant($tenantData);
            }
        }
        return null;
    }

    private function toTenant(array $data): Tenant
    {
        $tenant = new Tenant();
        $tenant->id = $data['id'];
        $tenant->name = $data['name'];
        $tenant->domain = $data['domain'];
        $tenant->database = $data['database'];
        return $tenant;
    }
}
