<?php

namespace Database\Seeders;

use App\Models\Sponsor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Sleep;


class SponsorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
            $sponsors = [
                [
                    'price' => 2.99,
                    'duration' => '24:00:00'
                ],
                [
                    'price' => 5.99,
                    'duration' => '72:00:00'
                ],
                [
                    'price' => 9.99,
                    'duration' => '144:00:00'
                ],
            ];
            
            foreach ($sponsors as $sponsor) {
                $newSponsor = new Sponsor();
                $newSponsor->fill($sponsor);
                $newSponsor->save();
            }
        
    }
}
