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
        if (!Schema::hasTable('client_family_members')) {
            Schema::create('client_family_members', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('client_id');
                $table->enum('relationship', ['father', 'mother', 'spouse', 'child', 'parent', 'sibling', 'other'])->default('other');

                // Personal Information
                $table->string('first_name');
                $table->string('last_name')->nullable();
                $table->date('date_of_birth')->nullable();
                $table->string('nationality')->nullable();
                $table->string('birth_place')->nullable();
                $table->string('country_of_birth')->nullable();

                // Contact Information
                $table->string('email')->nullable();
                $table->string('phone_number')->nullable();

                // Travel/Passport Information
                $table->string('passport_number')->nullable();
                $table->string('passport_country')->nullable();
                $table->string('passport_issue_place')->nullable();
                $table->string('passport_ic_number')->nullable();
                $table->date('passport_issue_date')->nullable();
                $table->date('passport_expiry_date')->nullable();

                // Employment Information
                $table->string('employment')->nullable();
                $table->string('employer_name')->nullable();
                $table->text('employer_address')->nullable();
                $table->string('employer_phone')->nullable();

                // Address Information
                $table->text('address')->nullable();
                $table->string('city')->nullable();
                $table->string('country')->nullable();

                // Additional Information
                $table->string('educational_qualification')->nullable();
                $table->text('identification_marks')->nullable();
                $table->string('religion')->nullable();

                // Military Information (if applicable)
                $table->boolean('military_status')->default(false);
                $table->string('military_organization')->nullable();
                $table->string('military_designation')->nullable();
                $table->string('military_rank')->nullable();
                $table->string('military_posting_place')->nullable();

                // Status and ordering
                $table->boolean('is_active')->default(true);
                $table->integer('sort_order')->default(0);

                $table->timestamps();
                $table->softDeletes();

                // Foreign key constraint
                $table->foreign('client_id')->references('id')->on('client_details')->onDelete('cascade');

                // Indexes
                $table->index(['client_id', 'relationship']);
                $table->index('is_active');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_family_members');
    }
};
