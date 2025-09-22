<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Agency;
use App\Helpers\DatabaseHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class VerifyTenantColumns extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenants:verify-columns {table=client_details} {columns=passport_no,date_of_issue,date_of_expire,place_of_issue}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verify that specified columns exist in tenant databases';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $table = $this->argument('table');
        $columns = explode(',', $this->argument('columns'));

        $agencies = Agency::all();

        if ($agencies->isEmpty()) {
            $this->error('No agencies found in the database.');
            return;
        }

        $this->info("Verifying columns in table: {$table}");
        $this->info("Columns to check: " . implode(', ', $columns));
        $this->newLine();

        foreach ($agencies as $agency) {
            $this->info("Checking agency: {$agency->name} (Database: {$agency->database_name})");

            try {
                // Set up the tenant database connection
                DatabaseHelper::setDatabaseConnection($agency->database_name);

                $missingColumns = [];
                foreach ($columns as $column) {
                    if (!Schema::connection('user_database')->hasColumn($table, trim($column))) {
                        $missingColumns[] = trim($column);
                    }
                }

                if (empty($missingColumns)) {
                    $this->info("✓ All columns exist in {$agency->database_name}");
                } else {
                    $this->error("✗ Missing columns in {$agency->database_name}: " . implode(', ', $missingColumns));
                }

            } catch (\Exception $e) {
                $this->error("✗ Error checking {$agency->database_name}: " . $e->getMessage());
            }

            $this->newLine();
        }

        $this->info('Column verification completed!');
    }
}
