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
        Schema::table('user_meta_deduction', function (Blueprint $table) {
            $table->json('othertaxslap')->nullable()->after('taxslab'); // Adjust column placement
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_meta_deduction', function (Blueprint $table) {
            $table->dropColumn('othertaxslap');
        });
    }
};
