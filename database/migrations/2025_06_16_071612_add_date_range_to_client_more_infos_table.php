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
    Schema::table('client_more_infos', function (Blueprint $table) {
        $table->date('date_from')->nullable();
        $table->date('date_to')->nullable();
    });
}

public function down()
{
    Schema::table('client_more_infos', function (Blueprint $table) {
        $table->dropColumn(['date_from', 'date_to']);
    });
}
};
