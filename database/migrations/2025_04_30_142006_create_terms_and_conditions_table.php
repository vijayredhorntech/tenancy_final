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
        Schema::create('terms_and_conditions', function (Blueprint $table) {
            $table->id();
        
            $table->foreignId('termtype_id')
                ->constrained('term_types')
                ->onDelete('cascade');

            $table->text('heading');
        
            $table->tinyInteger('select_default')->default(0); // 0 = false, 1 = true
            $table->tinyInteger('required')->default(0);       // 1 = required
            $table->string('type')->default('checkbox');       // checkbox, text, etc.
            $table->text('description');                       // Term details
            $table->tinyInteger('display_invoice')->default(0);
            $table->tinyInteger('status')->default(0); 
           
                               // Terms and conditions text
        
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('terms_and_conditions');
    }
};
