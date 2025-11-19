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
         Schema::table('request_applications', function (Blueprint $table) {
            $table->unsignedBigInteger('client_id')
                  ->nullable()
                  ->after('agency_id'); // Add column after agency_id
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('request_applications', function (Blueprint $table) {
            $table->dropColumn('client_id');
        });
    }
};
