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
        Schema::table('deductions', function (Blueprint $table) {
            $table->boolean('displaynotification')->default(0);
            $table->unsignedBigInteger('assign_team_id')->nullable();
            $table->unsignedBigInteger('assign_user_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('deductions', function (Blueprint $table) {
            $table->dropColumn(['displaynotification', 'assign_team_id', 'assign_user_id']);
        });
    }
};
