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
        Schema::create('apply_user_leaves', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->foreignId('leave_id')->constrained('leaves')->onDelete('cascade'); // References leaves table
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // User applying for leave
            $table->date('start_date');
            $table->date('end_date');
            $table->string('type_of_leave'); // Leave type reference
            $table->enum('status_of_leave', ['pending', 'approved', 'rejected','cancel'])->default('pending'); // Leave status
            $table->foreignId('reply_user_id')->nullable()->constrained('users')->onDelete('set null'); // Manager/Admin reviewing
            $table->text('reason')->nullable(); // Comments from admin
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apply_user_leaves');
    }
};
