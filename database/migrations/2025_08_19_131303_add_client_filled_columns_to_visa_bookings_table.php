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
            $table->timestamp('client_filled_at')->nullable()->after('sendtoadmin');
            $table->string('client_filled_by')->nullable()->after('client_filled_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('visabookings', function (Blueprint $table) {
            $table->dropColumn(['client_filled_at', 'client_filled_by']);
        });
    }
};
