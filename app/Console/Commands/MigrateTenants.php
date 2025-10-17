<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Artisan;
use App\Models\Agency;

class MigrateTenants extends Command
{
    protected $signature = 'tenants:migrate {--database= : The database name to migrate}';
    protected $description = 'Run migrations on all tenant databases or a specific tenant database';

    public function handle()
    {
        $specificDatabase = $this->option('database');

        if ($specificDatabase) {
            // Migrate specific database
            $this->migrateTenantDatabase($specificDatabase);
        } else {
            // Get all agencies with their databases
            $agencies = Agency::whereNotNull('database_name')
                ->where('database_name', '!=', '')
                ->get();

            if ($agencies->isEmpty()) {
                $this->error('No tenant databases found.');
                return 1;
            }

            $this->info("Found {$agencies->count()} tenant database(s).");

            foreach ($agencies as $agency) {
                $this->migrateTenantDatabase($agency->database_name);
            }

            $this->info('All tenant migrations completed!');
        }

        return 0;
    }

    protected function migrateTenantDatabase($databaseName)
    {
        $this->info("Migrating database: {$databaseName}");

        try {
            // Set the database for the user_database connection
            Config::set('database.connections.user_database.database', $databaseName);
            
            // Purge the connection to force reconnect with new database
            DB::purge('user_database');

            // Run migrations on the user_database connection
            Artisan::call('migrate', [
                '--database' => 'user_database',
                '--force' => true,
            ]);

            $this->line(Artisan::output());
            $this->info("✓ Successfully migrated: {$databaseName}");
        } catch (\Exception $e) {
            $this->error("✗ Failed to migrate {$databaseName}: " . $e->getMessage());
        }
    }
}
