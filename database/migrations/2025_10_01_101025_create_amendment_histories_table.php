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
        Schema::create('amendment_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('application_id'); // New Field
            $table->unsignedBigInteger('origin_id');
            $table->unsignedBigInteger('destination_id');
            $table->unsignedBigInteger('visa_id');
            $table->unsignedBigInteger('subtype_id');
            $table->unsignedBigInteger('agency_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('booking_id'); // New Field
            $table->string('visa_type')->nullable(); // New Field
            $table->string('application_number');
            $table->decimal('total_price', 10, 2)->nullable(); // New Field
            $table->date('dateofentry')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('amendment_histories');
    }
};
