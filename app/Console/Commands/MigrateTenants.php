<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Agency;
use App\Helpers\DatabaseHelper;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class MigrateTenants extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenants:migrate {--migration= : Specific migration to run} {--fresh : Drop all tables and re-run all migrations}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run migrations on all tenant databases';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $agencies = Agency::all();

        if ($agencies->isEmpty()) {
            $this->error('No agencies found in the database.');
            return;
        }

        $specificMigration = $this->option('migration');
        $fresh = $this->option('fresh');

        foreach ($agencies as $agency) {
            $this->info("Processing agency: {$agency->name} (Database: {$agency->database_name})");

            try {
                // Set up the tenant database connection
                DatabaseHelper::setDatabaseConnection($agency->database_name);

                if ($fresh) {
                    $this->info("Running fresh migrations for {$agency->database_name}...");
                    Artisan::call('migrate:fresh', [
                        '--database' => 'user_database',
                        '--force' => true
                    ]);
                } elseif ($specificMigration) {
                    $this->info("Running specific migration {$specificMigration} for {$agency->database_name}...");
                    Artisan::call('migrate', [
                        '--database' => 'user_database',
                        '--path' => $specificMigration,
                        '--force' => true
                    ]);
                } else {
                    $this->info("Running pending migrations for {$agency->database_name}...");
                    Artisan::call('migrate', [
                        '--database' => 'user_database',
                        '--force' => true
                    ]);
                }

                $this->info("✓ Successfully migrated {$agency->database_name}");

            } catch (\Exception $e) {
                $this->error("✗ Failed to migrate {$agency->database_name}: " . $e->getMessage());
            }
        }

        $this->info('All tenant migrations completed!');
    }
}
