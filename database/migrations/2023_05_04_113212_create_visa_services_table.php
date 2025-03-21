<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('visa_services', function (Blueprint $table) {
            $table->id();
            $table->string('title_image')->nullable();
            
            $table->foreignId('origin')->constrained('countries')->onDelete('cascade');
            $table->foreignId('destination')->constrained('countries')->onDelete('cascade');
        
            $table->timestamps();
        });
        

        
        
    }

    public function down()
    {
        Schema::dropIfExists('visa_services');
    }
};
