<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


class SponsorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
            $sponsrs = [
                [
                    'price' => 2.99,
                    'duration' => Carbon::createFromTime(24)
                ],
                [
                    'price' => 5.99,
                    'duration' => Carbon::createFromTime(72)
                ],
                [
                    'price' => 9.99,
                    'duration' => Carbon::createFromTime(144)
                ],
            ];
            DB::table('sponsors')->insert($sponsrs);
        
    }
}
