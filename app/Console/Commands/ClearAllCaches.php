<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ClearAllCaches extends Command
{
    /**
     * The name and signature of the console command.
     * ||||| php artisan clear:all  |||||||
     * @var string
     */
    protected $signature = 'clear:all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear all Laravel caches (route, config, view, optimize)';

    /**
     * Execute the console command.
     */
 public function handle()
{
    $this->call('route:clear');
    $this->call('config:clear');
    $this->call('cache:clear');
    $this->call('view:clear');
    $this->call('optimize:clear');

    $this->info('✅ All caches cleared successfully!');
}

}
