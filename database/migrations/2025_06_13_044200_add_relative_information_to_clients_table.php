<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelativeInformationToClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('client_more_infos', function (Blueprint $table) {
            $table->text('relative_information')->nullable();  // Add the column here
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('client_more_infos', function (Blueprint $table) {
            $table->dropColumn('relative_information');  // This will remove the column if rolled back
        });
    }
}
