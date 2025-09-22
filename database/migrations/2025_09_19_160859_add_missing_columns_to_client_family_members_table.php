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
        Schema::table('client_family_members', function (Blueprint $table) {
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

            $table->softDeletes();

            // Foreign key constraint
            $table->foreign('client_id')->references('id')->on('client_details')->onDelete('cascade');

            // Indexes
            $table->index(['client_id', 'relationship']);
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('client_family_members', function (Blueprint $table) {
            $table->dropForeign(['client_id']);
            $table->dropIndex(['client_family_members_client_id_relationship_index']);
            $table->dropIndex(['client_family_members_is_active_index']);

            $table->dropColumn([
                'client_id', 'relationship', 'first_name', 'last_name', 'date_of_birth',
                'nationality', 'birth_place', 'country_of_birth', 'email', 'phone_number',
                'passport_number', 'passport_country', 'passport_issue_place', 'passport_ic_number',
                'passport_issue_date', 'passport_expiry_date', 'employment', 'employer_name',
                'employer_address', 'employer_phone', 'address', 'city', 'country',
                'educational_qualification', 'identification_marks', 'religion', 'military_status',
                'military_organization', 'military_designation', 'military_rank', 'military_posting_place',
                'is_active', 'sort_order', 'deleted_at'
            ]);
        });
    }
};
