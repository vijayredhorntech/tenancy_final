<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('visabookings', function (Blueprint $table) {
            $table->tinyInteger('isamendment')
                  ->default(0)
                  ->after('confirm_application'); // Change position if needed
        });
    }

    public function down()
    {
        Schema::table('visabookings', function (Blueprint $table) {
            $table->dropColumn('isamendment');
        });
    }
};
