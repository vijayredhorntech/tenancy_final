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
        Schema::table('visa_service_country', function (Blueprint $table) {
            $table->longText('required_document')->nullable()->after('required'); // Adjust position as needed
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('visa_service_country', function (Blueprint $table) {
            $table->dropColumn('required_document');
        });
    }
};
