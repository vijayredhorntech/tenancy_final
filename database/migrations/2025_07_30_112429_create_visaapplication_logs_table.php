<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisaapplicationLogsTable extends Migration
{
    public function up()
    {
        Schema::create('visaapplication_logs', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('booking_id'); // Booking ID
            $table->string('application_number'); // Application Number
            $table->text('old_value'); // Old Value (before changes)
            $table->text('new_value'); // New Value (after changes)
            $table->string('type'); // Type of action (could be 'update', 'delete', etc.)
            $table->timestamps(); // Created at & Updated at timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('visaapplication_logs');
    }
}
