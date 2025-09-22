<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Only migrate data if the table exists
        if (Schema::hasTable('client_family_members')) {
            // Check if data has already been migrated by checking if any records exist
            $existingCount = DB::table('client_family_members')->count();

            if ($existingCount == 0) {
                // Migrate existing family member data from JSON fields to the new table
                $clientInfos = DB::table('client_more_infos')->get();

                foreach ($clientInfos as $clientInfo) {
                    $clientId = $clientInfo->clientid;
                    $sortOrder = 0;

                    // Migrate father details
                    if ($clientInfo->father_details) {
                        $fatherData = json_decode($clientInfo->father_details, true);
                        if ($fatherData && isset($fatherData['name'])) {
                            $nameParts = explode(' ', $fatherData['name'], 2);
                            DB::table('client_family_members')->insert([
                                'client_id' => $clientId,
                                'relationship' => 'father',
                                'first_name' => $nameParts[0] ?? '',
                                'last_name' => $nameParts[1] ?? '',
                                'date_of_birth' => $fatherData['dob'] ?? null,
                                'nationality' => $fatherData['nationality'] ?? null,
                                'birth_place' => $fatherData['birth_place'] ?? null,
                                'country_of_birth' => $fatherData['country_of_birth'] ?? null,
                                'employment' => $fatherData['employment'] ?? null,
                                'address' => $fatherData['address'] ?? null,
                                'sort_order' => $sortOrder++,
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }

                    // Migrate mother details
                    if ($clientInfo->mother_details) {
                        $motherData = json_decode($clientInfo->mother_details, true);
                        if ($motherData && isset($motherData['name'])) {
                            $nameParts = explode(' ', $motherData['name'], 2);
                            DB::table('client_family_members')->insert([
                                'client_id' => $clientId,
                                'relationship' => 'mother',
                                'first_name' => $nameParts[0] ?? '',
                                'last_name' => $nameParts[1] ?? '',
                                'date_of_birth' => $motherData['dob'] ?? null,
                                'nationality' => $motherData['nationality'] ?? null,
                                'birth_place' => $motherData['birth_place'] ?? null,
                                'country_of_birth' => $motherData['country_of_birth'] ?? null,
                                'employment' => $motherData['employment'] ?? null,
                                'address' => $motherData['address'] ?? null,
                                'sort_order' => $sortOrder++,
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }

                    // Migrate spouse details
                    if ($clientInfo->spouse_details) {
                        $spouseData = json_decode($clientInfo->spouse_details, true);
                        if ($spouseData && isset($spouseData['name'])) {
                            $nameParts = explode(' ', $spouseData['name'], 2);
                            DB::table('client_family_members')->insert([
                                'client_id' => $clientId,
                                'relationship' => 'spouse',
                                'first_name' => $nameParts[0] ?? '',
                                'last_name' => $nameParts[1] ?? '',
                                'date_of_birth' => $spouseData['dob'] ?? null,
                                'nationality' => $spouseData['nationality'] ?? null,
                                'birth_place' => $spouseData['birth_place'] ?? null,
                                'country_of_birth' => $spouseData['country_of_birth'] ?? null,
                                'employment' => $spouseData['employment'] ?? null,
                                'address' => $spouseData['address'] ?? null,
                                'sort_order' => $sortOrder++,
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }

                    // Migrate children details
                    if ($clientInfo->children) {
                        $childrenData = json_decode($clientInfo->children, true);
                        if (is_array($childrenData)) {
                            foreach ($childrenData as $child) {
                                if (isset($child['name'])) {
                                    $nameParts = explode(' ', $child['name'], 2);
                                    DB::table('client_family_members')->insert([
                                        'client_id' => $clientId,
                                        'relationship' => 'child',
                                        'first_name' => $nameParts[0] ?? '',
                                        'last_name' => $nameParts[1] ?? '',
                                        'date_of_birth' => $child['dob'] ?? null,
                                        'nationality' => $child['nationality'] ?? null,
                                        'address' => $child['address'] ?? null,
                                        'sort_order' => $sortOrder++,
                                        'created_at' => now(),
                                        'updated_at' => now(),
                                    ]);
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // This migration is not reversible as it migrates data
        // The data will remain in the new table
    }
};
