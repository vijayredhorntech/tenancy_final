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
            $table->string('passport_no')->nullable()->after('country');
            $table->date('date_of_issue')->nullable()->after('passport_no');
            $table->date('date_of_expire')->nullable()->after('date_of_issue');
            $table->string('place_of_issue')->nullable()->after('date_of_expire');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('client_details', function (Blueprint $table) {
            $table->dropColumn(['passport_no', 'date_of_issue', 'date_of_expire', 'place_of_issue']);
        });
    }
};
