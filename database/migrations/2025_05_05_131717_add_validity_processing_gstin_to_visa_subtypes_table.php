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
            $table->string('validity')->nullable()->after('status');
            $table->string('processing')->nullable()->after('validity');
            $table->string('gstin')->nullable()->after('processing');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('visa_subtypes', function (Blueprint $table) {
            //
            $table->dropColumn(['validity', 'processing', 'gstin']);
        });
    }
};
