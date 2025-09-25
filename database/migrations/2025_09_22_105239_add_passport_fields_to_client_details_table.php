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
        Schema::table('client_details', function (Blueprint $table) {
            $table->string('passport_ic_number')->nullable()->after('permanent_address');
            $table->date('passport_issue_date')->nullable()->after('passport_ic_number');
            $table->date('passport_expiry_date')->nullable()->after('passport_issue_date');
            $table->string('passport_issue_place')->nullable()->after('passport_expiry_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('client_details', function (Blueprint $table) {
            $table->dropColumn([
                'passport_ic_number',
                'passport_issue_date',
                'passport_expiry_date',
                'passport_issue_place'
            ]);
        });
    }
};
