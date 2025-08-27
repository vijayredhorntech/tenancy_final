<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('request_applications', function (Blueprint $table) {
            // Make existing fields nullable
            $table->string('service_type')->nullable()->change();
            $table->unsignedBigInteger('agency_id')->nullable()->change();
            $table->unsignedBigInteger('country_id')->nullable()->change();
            $table->unsignedBigInteger('visa_id')->nullable()->change();
            $table->unsignedBigInteger('visa_subtype')->nullable()->change();
            $table->string('first_name')->nullable()->change();
            $table->string('last_name')->nullable()->change();
            $table->string('full_name')->nullable()->change();
            $table->string('email')->nullable()->change();
            $table->string('phone_number')->nullable()->change();
            $table->string('nationality')->nullable()->change();
            $table->string('zipcode')->nullable()->change();
            $table->string('address')->nullable()->change();
            $table->string('city')->nullable()->change();
            $table->date('date_of_entry')->nullable()->change();
            $table->string('status')->nullable()->change();
            $table->timestamp('created_at')->nullable()->change();
            $table->timestamp('updated_at')->nullable()->change();

            // Add new nullable longtext fields
            $table->longText('adultdetails')->nullable();
            $table->longText('childrendetails')->nullable();
            $table->longText('infantsdetails')->nullable();
            $table->longText('details')->nullable();
            $table->longText('flightserach')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('request_applications', function (Blueprint $table) {
            // Drop new columns
            $table->dropColumn(['adultdetails', 'childrendetails', 'infantsdetails', 'details', 'flightserach']);

            // Rollback nullable changes (set back to not nullable)
            $table->string('service_type')->nullable(false)->change();
            $table->unsignedBigInteger('agency_id')->nullable(false)->change();
            $table->unsignedBigInteger('country_id')->nullable(false)->change();
            $table->unsignedBigInteger('visa_id')->nullable(false)->change();
            $table->unsignedBigInteger('visa_subtype')->nullable(false)->change();
            $table->string('first_name')->nullable(false)->change();
            $table->string('last_name')->nullable(false)->change();
            $table->string('full_name')->nullable(false)->change();
            $table->string('email')->nullable(false)->change();
            $table->string('phone_number')->nullable(false)->change();
            $table->string('nationality')->nullable(false)->change();
            $table->string('zipcode')->nullable(false)->change();
            $table->string('address')->nullable(false)->change();
            $table->string('city')->nullable(false)->change();
            $table->date('date_of_entry')->nullable(false)->change();
            $table->string('status')->nullable(false)->default('pending')->change();
            $table->timestamp('created_at')->nullable(false)->change();
            $table->timestamp('updated_at')->nullable(false)->change();
        });
    }
};
