<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('agency_requests', function (Blueprint $table) {
            $table->id();
            $table->string('agency_name');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('business_type');
            $table->json('services'); // store services as JSON
            $table->string('experience');
            $table->boolean('approved')->default(false); // track approval status
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('agency_requests');
    }
};
