<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    { 
        
        Schema::table('services', function (Blueprint $table) {
        $table->tinyInteger('add_sidebar')->default(1)->comment('0 = Inactive, 1 = Active');
       });
    }
};
