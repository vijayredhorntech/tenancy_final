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
        Schema::table('agency_details', function (Blueprint $table) {
            $table->json('agency_document')->nullable()->after('vat_number'); // Replace existing_column_name
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('agency_details', function (Blueprint $table) {
            $table->dropColumn('agency_document');
        });
    }
};
