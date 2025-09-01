<?php

namespace Infrastructure\Framework\Middleware;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Multitenancy\Tasks\SwitchTenantDatabaseTask as BaseSwitchTenantDatabaseTask;

class SwitchTenantDatabaseTask extends BaseSwitchTenantDatabaseTask
{
    protected function setTenantConnectionDatabaseName(?string $databaseName): void
    {
        $tenantConnectionName = is_null($databaseName)
            ? $this->landlordDatabaseConnectionName()
            : $this->tenantDatabaseConnectionName();

        // Leer base actual configurada
        $currentDatabase = config("database.connections.{$tenantConnectionName}.database");

        Log::info('Antes del cambio de conexión tenant', [
            'database_actual' => $currentDatabase,
            'database_nueva' => $databaseName,
        ]);

        if ($currentDatabase === $databaseName) {
            /*Log::info('SwitchTenantDatabaseTask: conexión tenant sin cambios', [
                'database' => $databaseName,
            ]);*/
            return;
        }

        parent::setTenantConnectionDatabaseName($databaseName);

        DB::setDefaultConnection($tenantConnectionName);

       
    }
}
