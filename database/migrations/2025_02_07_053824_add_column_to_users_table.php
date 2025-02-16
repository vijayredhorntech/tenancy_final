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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('status', ['online', 'offline'])->default('offline')->after('email'); // Status column
            $table->timestamp('login_time')->nullable()->after('status'); // Login time column
            $table->string('profile')->nullable()->after('login_time'); // Profile column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['status', 'login_time', 'profile']);
        });
    }
};
