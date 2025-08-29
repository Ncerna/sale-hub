<?php
return [
    'tenant_model' => App\Models\Tenant::class,
    'tenant_finder' => Infrastructure\ServiceImplementations\ApiHeaderTenantFinder::class,
    'tenant_database_connection_name' => 'tenant',
    'switch_tenant_tasks' => [
        Spatie\Multitenancy\Tasks\SwitchTenantDatabaseTask::class,
    ],
    // otras configuraciones que necesites
];
