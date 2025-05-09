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
            $table->tinyInteger('sendtoadmin')->default(0)->after('status'); // replace with the actual column name to place it after
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('visabookings', function (Blueprint $table) {
            $table->dropColumn('sendtoadmin');
        });
    }
};
