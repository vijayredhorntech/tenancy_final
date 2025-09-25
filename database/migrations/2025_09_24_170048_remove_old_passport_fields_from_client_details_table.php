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
            // Check if old columns exist and drop them if they do
            if (Schema::hasColumn('client_details', 'passport_no')) {
                $table->dropColumn('passport_no');
            }
            if (Schema::hasColumn('client_details', 'date_of_issue')) {
                $table->dropColumn('date_of_issue');
            }
            if (Schema::hasColumn('client_details', 'date_of_expire')) {
                $table->dropColumn('date_of_expire');
            }
            if (Schema::hasColumn('client_details', 'place_of_issue')) {
                $table->dropColumn('place_of_issue');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('client_details', function (Blueprint $table) {
            // Add back the old columns if needed for rollback
            $table->string('passport_no')->nullable();
            $table->date('date_of_issue')->nullable();
            $table->date('date_of_expire')->nullable();
            $table->string('place_of_issue')->nullable();
        });
    }
};