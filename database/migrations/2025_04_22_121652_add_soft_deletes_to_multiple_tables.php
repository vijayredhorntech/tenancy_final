<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSoftDeletesToMultipleTables extends Migration
{
    /**
     * Tables to apply soft deletes.
     */
    protected $tables = [
        'add_balances','agencies', 'agency_details', 'airlines', 'airports', 'apply_user_leaves',
        'assignments', 'attendances', 'authervisa_applications', 'balances', 'cache',
        'cache_locks', 'cities', 'client_details', 'client_more_infos', 'countries',
        'deductions', 'domains', 'failed_jobs', 'flight_bookings', 'flight_bookings_passenger_details',
        'flight_settings', 'fromdocuments', 'hotel_booking_details', 'hotel_bookings',
        'job_batches', 'jobs', 'leave_assigns', 'leave_balances', 'leaves', 'login_details',
        'messages', 'migrations', 'model_has_permissions', 'model_has_roles',
        'password_reset_tokens', 'permissions', 'personal_access_tokens',
        'role_has_permissions', 'roles', 'salaries', 'services', 'sessions', 'supports',
        'team_managements', 'team_user', 'terms_conditions', 'user_activity_logs', 'user_meta',
        'user_meta_deduction', 'user_meta_passportdetails', 'user_service_assignments',
        'users', 'visa_service_country', 'visa_service_type_entries',
        'visa_service_type_faqs', 'visa_service_type_notes', 'visa_services',
        'visa_subtypes', 'visa_types','visabookings'
    ];
    

    public function up(): void
    {
        foreach ($this->tables as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                if (!Schema::hasColumn($table->getTable(), 'deleted_at')) {
                    $table->softDeletes();
                }
            });
        }
    }

    public function down(): void
    {
        foreach ($this->tables as $tableName) {
            if (Schema::hasColumn($tableName, 'deleted_at')) {
                Schema::table($tableName, function (Blueprint $table) use ($tableName) {
                    $table->dropSoftDeletes();
                });
            }
        }
    }
    
}
