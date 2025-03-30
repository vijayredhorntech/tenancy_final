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
        Schema::table('authervisa_applications', function (Blueprint $table) {
            $table->string('passport_number')->nullable()->after('citizenship');
            $table->date('passport_issue_date')->nullable()->after('passport_number');
            $table->date('passport_expire_date')->nullable()->after('passport_issue_date');
            $table->string('place_of_issue')->nullable()->after('passport_expire_date');
            $table->string('passportphoto')->nullable()->after('place_of_issue');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('authervisa_applications', function (Blueprint $table) {
            //
        });
    }
};
