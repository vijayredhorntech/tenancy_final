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
            $table->boolean('personal_details_permission')->default(false);
            $table->boolean('other_details_permission')->default(false); // gender, dob, marital status
            $table->boolean('address_permission')->default(false);
            $table->boolean('passport_details_permission')->default(false);
            $table->boolean('additional_passport_info_permission')->default(false);
            $table->boolean('family_details_permission')->default(false);
            $table->boolean('wife_details_permission')->default(false);
            $table->boolean('occupation_details_permission')->default(false);
            $table->boolean('armed_force_details_permission')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('client_more_infos', function (Blueprint $table) {
            $table->dropColumn([
                'personal_details_permission',
                'other_details_permission',
                'address_permission',
                'passport_details_permission',
                'additional_passport_info_permission',
                'family_details_permission',
                'wife_details_permission',
                'occupation_details_permission',
                'armed_force_details_permission',
            ]);
        });
    }
};
