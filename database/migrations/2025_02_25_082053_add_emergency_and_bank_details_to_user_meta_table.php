<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('user_meta', function (Blueprint $table) {
            // Emergency Contact Details
            $table->string('emergency_person_name')->nullable();
            $table->string('emergency_contact_number')->nullable();
            $table->string('emergency_email_id')->nullable();

            // Bank Account Details
            $table->string('account_number')->nullable();
            $table->string('short_code')->nullable();
            $table->string('bank_name')->nullable();

           $table->string('wages_type')->nullable()->after('bank_name');
            $table->string('wage')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_meta', function (Blueprint $table) {
            $table->dropColumn([
                'emergency_person_name',
                'emergency_contact_number',
                'emergency_email_id',
                'account_number',
                'short_code',
                'bank_name',
                'wages_type',
                'wage',
            ]);
        });
    }
};
