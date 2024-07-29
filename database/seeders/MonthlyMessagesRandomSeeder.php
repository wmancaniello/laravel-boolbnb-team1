<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;

class MonthlyMessagesRandomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();
        $now = Carbon::now();
        $lastYear = Carbon::now()->subYear();

        // Numero di messaggi da creare
        $numberOfMessages = 100;

        for ($i = 0; $i < $numberOfMessages; $i++) {
            // Genera una data casuale tra l'anno scorso e oggi
            $randomDate = $faker->dateTimeBetween($lastYear, $now);

            // Trova un ID di appartamento casuale
            $flatId = DB::table('flats')->inRandomOrder()->value('id');

            DB::table('messages')->insert([
                'flat_id' => $flatId,
                'email' => $faker->email,
                'name' => $faker->name,
                'text' => $faker->text,
                'created_at' => $randomDate,
                'updated_at' => $now,
            ]);
        }
    }
}
