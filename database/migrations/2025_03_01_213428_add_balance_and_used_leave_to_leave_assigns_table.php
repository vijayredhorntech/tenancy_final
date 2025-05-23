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
        Schema::table('leave_assigns', function (Blueprint $table) {
            $table->integer('balance_leave')->default(0)->after('leave_type'); // Replace with the correct column
            $table->integer('used_leave')->default(0)->after('balance_leave');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('leave_assigns', function (Blueprint $table) {
            $table->dropColumn(['balance_leave', 'used_leave']);
        });
    }
};
