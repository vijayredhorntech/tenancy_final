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
        $table->string('has_military')->nullable();
        $table->json('military_info')->nullable();
    });
}

public function down()
{
    Schema::table('client_more_infos', function (Blueprint $table) {
        $table->dropColumn(['has_military', 'military_info']);
    });
}
};
