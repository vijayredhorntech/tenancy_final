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
        Schema::table('visa_subtypes', function (Blueprint $table) {
            $table->unsignedBigInteger('visa_type_id')->nullable()->after('country_type_id'); // Or position it as needed
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('visa_subtypes', function (Blueprint $table) {
            $table->dropColumn('visa_type_id');
        });
    }
};
