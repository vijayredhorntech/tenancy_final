<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('visabookings', function (Blueprint $table) {
            // $table->decimal('amount', 10, 2)
            //   ->nullable()
            //   ->after('total_amount');  // You can change the position if needed
            $table->tinyInteger('isamendment')
                  ->default(0)
                  ->after('confirm_application'); // Change position if needed
        });
    }

    public function down()
    {
        Schema::table('visabookings', function (Blueprint $table) {
             $table->dropColumn(['isamendment']);
        });
    }
};
