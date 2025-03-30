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
        Schema::table('assignments', function (Blueprint $table) {
            $table->enum('assign_to', ['team', 'user'])->nullable()->after('description');
            $table->unsignedBigInteger('assign_id')->nullable()->after('assign_to');

            // No foreign keys because assign_id can refer to either users or teams
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('assignments', function (Blueprint $table) {
            $table->dropColumn(['assign_to', 'assign_id']);
        });
    }
};
