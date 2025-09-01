<?php
return [
    'tenant_model' => App\Models\Tenant::class,
    'tenant_finder' => Infrastructure\ServiceImplementations\ApiHeaderTenantFinder::class,
    'tenant_database_connection_name' => 'tenant',
    'landlord_database_connection_name' => 'landlord',
    'switch_tenant_tasks' => [
        \Infrastructure\Framework\Middleware\SwitchTenantDatabaseTask::class,
    ],
    'tenant' => [
        \Spatie\Multitenancy\Http\Middleware\NeedsTenant::class,
        \Spatie\Multitenancy\Http\Middleware\EnsureValidTenantSession::class,
        \Infrastructure\Framework\Middleware\IdentifyTenant::class,
    ],
];

