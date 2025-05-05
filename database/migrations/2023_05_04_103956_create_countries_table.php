<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('countryCode');
            $table->string('countryName');
            $table->timestamps();
        });
    }

    // public function down()
    // {
    //     Schema::dropIfExists('countries');
    // }
    public function down(): void
{
    Schema::disableForeignKeyConstraints();
    Schema::dropIfExists('countries');
    Schema::enableForeignKeyConstraints();
}

};
