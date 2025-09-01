<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MigrateTenant extends Command
{
    /**||||||| php artisan migrate:tenant --tenant=123|||||

     * The name and signature of the console command.
     * Puedes pasar uno o varios tenants con --tenant=1 o --tenant=1,2
     * php artisan migrate:tenant --tenant=123
     *
     * @var string
     */
    protected $signature = 'migrate:tenant {--tenant=*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run tenant migrations for specified tenants';
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tenants = $this->option('tenant');
        // Usar comando tenants:artisan para ejecutar migraciones para cada tenant
        $command = 'tenants:artisan';
        $params = ['command' => 'migrate', '--path' => 'database/migrations/tenant'];
        if ($tenants && count($tenants) > 0) {
            foreach ($tenants as $tenantId) {
                $this->info("Migrating tenant $tenantId...");
                $this->call($command, array_merge($params, ['--tenant' => $tenantId]));
            }
        } else {
            $this->info("Migrating all tenants...");
            $this->call($command, $params);
        }
        $this->info('Tenant migrations completed successfully!');
    }
}
