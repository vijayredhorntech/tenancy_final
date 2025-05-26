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
            $table->boolean('children_permission')->nullable()->after('wife_details_permission');
            $table->boolean('armed_permission')->nullable()->after('armed_force_details_permission'); // Replace with actual existing column
            $table->text('arms_details')->nullable()->after('armed_permission');
         
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('client_more_infos', function (Blueprint $table) {
            $table->dropColumn(['armed_permission', 'arms_details', 'children_permission']);
        });
    }
};
