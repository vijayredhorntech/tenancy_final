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
        Schema::table('client_more_infos', function (Blueprint $table) {
            $table->boolean('previous_name_status')->nullable()->after('previous_name');
        });
    }

    public function down(): void
    {
        Schema::table('client_more_infos', function (Blueprint $table) {
            $table->dropColumn('previous_name_status');
        });
    }
};
