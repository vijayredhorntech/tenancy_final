<?php

namespace Database\Seeders;

use App\Models\Flight\FlightSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class FlightSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('flight_settings')->insert([
            'markupType' => 'percentage',
            'markupValue' => '2',
            'fareType' => 'public',
            'type' => 'default',
            'validFrom' => null,
            'validTill' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
