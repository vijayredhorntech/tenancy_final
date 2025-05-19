<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    
    public function up()
    {
        Schema::table('visa_subtypes', function (Blueprint $table) {
            // Drop the foreign key constraint (you need the name or let Laravel guess)
            $table->dropForeign(['visa_type_id']);

            // Rename the column
            $table->renameColumn('visa_type_id', 'country_type_id');
        });
    }

    public function down()
    {
        Schema::table('visa_subtypes', function (Blueprint $table) {
            // Rename back the column
            $table->renameColumn('country_type_id', 'visa_type_id');

            // Re-add the foreign key (assuming it referenced `visa_types` table)
            $table->foreign('visa_type_id')->references('id')->on('visa_types')->onDelete('cascade');
        });
    }

};
