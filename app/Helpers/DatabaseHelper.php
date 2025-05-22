<?php
namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class DatabaseHelper
{
    // public static function createDatabaseForUser($databaseName, $agency, $profile)
    // {
    //     // Validate database name
    //     if (empty($databaseName)) {
    //         throw new \Exception('Database name cannot be empty.');
    //     }
    
    //      $databaseName = preg_replace('/[^a-zA-Z0-9_]/', '', $databaseName);
    
    //     // Create database
    //     DB::statement("CREATE DATABASE `$databaseName`");
    
    //     // Update config to use the new database
    //     config(['database.connections.tenant.database' => $databaseName]);
    
    //     // Reconnect to apply new database settings
    //     DB::purge('tenant');
    //     DB::reconnect('tenant');
    
    //     // Run migrations for the new database
    //     Artisan::call('migrate', ['--database' => 'tenant', '--path' => 'database/migrations']);

    //     Artisan::call('db:seed', [
    //         '--database' => 'tenant',
    //         '--class' => 'RoleSeeder' // Change to your actual seeder class
    //     ]);
    
    //     // Insert user into the new database
    //     DB::connection('tenant')->table('users')->insert([
    //         'name' => $agency->name,
    //         'email' => $agency->email,
    //         'password' => Hash::make($agency->email),
    //         'profile' => $profile,
    //     ]);
    // }

    public static function createDatabaseForUser($databaseName, $agency, $profile)
{
    // Validate and sanitize database name
    $databaseName = preg_replace('/[^a-zA-Z0-9_]/', '', $databaseName);
    if (empty($databaseName)) {
        Log::error('Database name cannot be empty.');
        return false;
    }

    try {
        // Create database
        if (app()->environment('local')) {
            DB::statement("CREATE DATABASE `$databaseName`");
        }
        
      

        // Update config to use the new database
        // config(['database.connections.tenant.database' => $databaseName]);
        config(['database.connections.tenant' => [
            'driver'    => 'mysql',
            'host'      => env('DB_HOST', '127.0.0.1'),
            'port'      => env('DB_PORT', '3306'),
            'database'  => $databaseName,
            'username'  => $agency->database_user ?? env('DB_USERNAME'),
            'password'  => $agency->database_password ?? env('DB_PASSWORD'),
            'charset'   => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
        ]]);

        // Reconnect to apply new settings
        DB::purge('tenant');
        DB::reconnect('tenant');

        // Run migrations
        Artisan::call('migrate', ['--database' => 'tenant', '--path' => 'database/migrations']);

        // Run seeder
        Artisan::call('db:seed', [
            '--database' => 'tenant',
            '--class' => 'RoleSeeder' // Customize as needed
        ]);

        // Insert user into the new database
        DB::connection('tenant')->table('users')->insert([
            'name' => $agency->name,
            'email' => $agency->email,
            'password' => Hash::make($agency->email),
            'profile' => $profile,
        ]);

        return true;

    } catch (\Exception $e) {
        dd($e);
        Log::error("Failed to create tenant database '$databaseName': " . $e->getMessage());

        // Attempt to drop the database if it was created
        try {
            DB::statement("DROP DATABASE IF EXISTS `$databaseName`");
            Log::info("Rolled back database creation: '$databaseName'");
        } catch (\Exception $dropError) {
            Log::error("Failed to rollback database '$databaseName': " . $dropError->getMessage());
        }

        return false;
    }
}

    

      /**
     * Set the database connection dynamically.
     */
    // public static function setDatabaseConnection($databaseName)
    // {
    //     config(['database.connections.user_database' => [
    //         'driver' => 'mysql',
    //         'host' => env('DB_HOST', '127.0.0.1'),
    //         'database' => $databaseName,
    //         'username' => env('DB_USERNAME'),
    //         'password' => env('DB_PASSWORD'),
    //         // 'username' => config('database.connections.mysql.username'),
    //         // 'password' => config('database.connections.mysql.password'),
    //     ]]);
    // }   

    public static function setDatabaseConnection($databaseName, $agency = null)
{
    // Fallback values
    $defaultUsername = env('DB_USERNAME');
    $defaultPassword = env('DB_PASSWORD');

    // Use agency's database credentials if provided and not null
    $username = $agency && $agency->database_user ? $agency->database_user : $defaultUsername;
    $password = $agency && $agency->database_password ? $agency->database_password : $defaultPassword;

    // Set dynamic connection

    
    config(['database.connections.user_database' => [
          'driver' => 'mysql',
            'host' => env('DB_HOST', '127.0.0.1'),
            'database' => $databaseName,
            'username' => $username,
            'password' =>  $password,
       
    ]]);
}

    /****Drop Data base ***** */

    public static function deleteDatabaseByName($databaseName)
    {
        // Sanitize database name to avoid injection
        $databaseName = preg_replace('/[^a-zA-Z0-9_]/', '', $databaseName);
    
        if (empty($databaseName)) {
            Log::error('Database name cannot be empty.');
            return false;
        }
    
        try {
            // Drop the database
            DB::statement("DROP DATABASE `$databaseName`");
            Log::info("Database '$databaseName' has been deleted.");
            return true;
        } catch (\Exception $e) {
            Log::error("Failed to delete database '$databaseName': " . $e->getMessage());
            return false;
        }
    }
    

  


    /*** Flag of **** */



    public static function getCountries()
    {
        return [
            ['code' => 'US', 'name' => 'United States', 'dial_code' => '+1', 'flag' => '🇺🇸'],
            ['code' => 'IN', 'name' => 'India', 'dial_code' => '+91', 'flag' => '🇮🇳'],
            ['code' => 'GB', 'name' => 'United Kingdom', 'dial_code' => '+44', 'flag' => '🇬🇧'],
            ['code' => 'DE', 'name' => 'Germany', 'dial_code' => '+49', 'flag' => '🇩🇪'],
            ['code' => 'FR', 'name' => 'France', 'dial_code' => '+33', 'flag' => '🇫🇷'],
            ['code' => 'AU', 'name' => 'Australia', 'dial_code' => '+61', 'flag' => '🇦🇺'],
            ['code' => 'CA', 'name' => 'Canada', 'dial_code' => '+1', 'flag' => '🇨🇦'],
            ['code' => 'BR', 'name' => 'Brazil', 'dial_code' => '+55', 'flag' => '🇧🇷'],
            ['code' => 'ZA', 'name' => 'South Africa', 'dial_code' => '+27', 'flag' => '🇿🇦'],
            ['code' => 'JP', 'name' => 'Japan', 'dial_code' => '+81', 'flag' => '🇯🇵'],
            ['code' => 'CN', 'name' => 'China', 'dial_code' => '+86', 'flag' => '🇨🇳'],
            ['code' => 'RU', 'name' => 'Russia', 'dial_code' => '+7', 'flag' => '🇷🇺'],
            ['code' => 'IT', 'name' => 'Italy', 'dial_code' => '+39', 'flag' => '🇮🇹'],
            ['code' => 'ES', 'name' => 'Spain', 'dial_code' => '+34', 'flag' => '🇪🇸'],
            ['code' => 'MX', 'name' => 'Mexico', 'dial_code' => '+52', 'flag' => '🇲🇽'],
        ];
    }



  
}

?>