<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('services')->insert([
            ['name' => 'Hotel', 'icon' =>'<i class="fa fa-hotel mr-2 text-sm"></i>','created_at' => now(),'price'=>'0','updated_at' => now()],
            ['name' => 'Flight','icon' =>'<i class="fa fa-plane-departure mr-2 text-sm"></i>', 'created_at' => now(), 'price'=>'0','updated_at' => now()],
            ['name' => 'Visa','icon' =>'<i class="fa-brands fa-cc-visa mr-2 text-sm"></i>', 'created_at' => now(), 'price'=>'0','updated_at' => now()],
        ]);
    }
}
