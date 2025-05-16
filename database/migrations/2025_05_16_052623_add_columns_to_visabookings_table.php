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
        Schema::table('visabookings', function (Blueprint $table) {
            $table->tinyInteger('assign_user')->default(0);
            $table->tinyInteger('confirm_application')->default(0);
            $table->tinyInteger('display_notification')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('visabookings', function (Blueprint $table) {
            $table->dropColumn(['assign_user', 'confirm_application', 'display_notification']);
        });
    }
};
