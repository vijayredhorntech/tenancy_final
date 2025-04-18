<?php
namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;

class DatabaseHelper
{
    public static function createDatabaseForUser($databaseName, $agency, $profile)
    {
        // Validate database name
        if (empty($databaseName)) {
            throw new \Exception('Database name cannot be empty.');
        }
    
         $databaseName = preg_replace('/[^a-zA-Z0-9_]/', '', $databaseName);
    
        // Create database
        DB::statement("CREATE DATABASE `$databaseName`");
    
        // Update config to use the new database
        config(['database.connections.tenant.database' => $databaseName]);
    
        // Reconnect to apply new database settings
        DB::purge('tenant');
        DB::reconnect('tenant');
    
        // Run migrations for the new database
        Artisan::call('migrate', ['--database' => 'tenant', '--path' => 'database/migrations']);

        Artisan::call('db:seed', [
            '--database' => 'tenant',
            '--class' => 'RoleSeeder' // Change to your actual seeder class
        ]);
    
        // Insert user into the new database
        DB::connection('tenant')->table('users')->insert([
            'name' => $agency->name,
            'email' => $agency->email,
            'password' => Hash::make($agency->email),
            'profile' => $profile,
        ]);
    }
    

      /**
     * Set the database connection dynamically.
     */
    public static function setDatabaseConnection($databaseName)
    {
        config(['database.connections.user_database' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '127.0.0.1'),
            'database' => $databaseName,
            'username' => env('DB_USERNAME'),
            'password' => env('DB_PASSWORD'),
        ]]);
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