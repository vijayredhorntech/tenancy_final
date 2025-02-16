<?php

namespace Database\Seeders;

use App\Models\Flight\FlightSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FlightSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'markupType' => 'percentage',
                'markupValue' => '2',
                'fareType' => 'public',
                'type' => 'default',
            ],
        ];

        foreach ($settings as $setting) {
            FlightSetting::create($setting);
        }
    }
}
