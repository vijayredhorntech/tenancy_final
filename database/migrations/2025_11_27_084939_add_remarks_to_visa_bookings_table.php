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
                $table->text('client_remark')->nullable()->after('custom_message');
                $table->text('agency_remark')->nullable()->after('client_remark');
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('visabookings', function (Blueprint $table) {
                $table->dropColumn('client_remark');
                $table->dropColumn('agency_remark');
            });
    }
};
