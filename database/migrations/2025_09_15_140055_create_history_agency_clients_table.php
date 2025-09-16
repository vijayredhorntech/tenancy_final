<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('history_agency_clients', function (Blueprint $table) {
            $table->id();

            // Just IDs, no foreign key constraints
            $table->unsignedBigInteger('user_id');   // who created entry
            $table->unsignedBigInteger('client_id'); // client reference
            $table->unsignedBigInteger('agency_id'); // agency reference

            // History details
            $table->dateTime('date_time'); // event date
            $table->string('type')->nullable(); // e.g., call, meeting, email
            $table->text('description')->nullable(); // notes
            $table->string('status')->nullable(); // success, pending, cancelled etc.

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('history_agency_clients');
    }
};
