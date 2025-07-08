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
            Schema::table('visabookings', function (Blueprint $table) {
                $table->boolean('viewed_once')->nullable();
            });
        }

        public function down()
        {
            Schema::table('visabookings', function (Blueprint $table) {
                $table->dropColumn('viewed_once');
            });
        }

};
