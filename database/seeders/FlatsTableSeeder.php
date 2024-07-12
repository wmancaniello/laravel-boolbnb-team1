<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FlatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $flats = [
            [
                "title" => "GRAN MADRE Suite elegante con terrazzo",
                "max_guests" => 4,
                "rooms" => 3,
                "beds" => 2,
                "bathrooms" => 2,
                "meters_square" => 90,
                "address" => "Piazza Gran Madre di Dio, 10131 Torino TO, Italy",
                "latitude" => 45.066365,
                "longitude" => 7.693069,
                "main_img" => "thumbnail_GRAN_MADRE_Suite_elegante_con_terrazzo",
                "visible" => true,
                "description" => "Elegante suite con terrazzo, situata vicino alla storica Gran Madre."
            ],
            [
                "title" => "Elegante appartamento con terrazzino vista MOLE",
                "max_guests" => 3,
                "rooms" => 2,
                "beds" => 1,
                "bathrooms" => 1,
                "meters_square" => 75,
                "address" => "Via Montebello, 10124 Torino TO, Italy",
                "latitude" => 45.069167,
                "longitude" => 7.692576,
                "main_img" => "thumbnail_Elegante_appartamento_con_terrazzino_vista_MOLE",
                "visible" => true,
                "description" => "Appartamento elegante con terrazzino, splendida vista sulla Mole Antonelliana."
            ],
            [
                "title" => "Dimora Novecento",
                "max_guests" => 5,
                "rooms" => 4,
                "beds" => 2,
                "bathrooms" => 2,
                "meters_square" => 110,
                "address" => "Via Po, 10123 Torino TO, Italy",
                "latitude" => 45.068267,
                "longitude" => 7.686856,
                "main_img" => "thumbnail_Dimora_Novecento",
                "visible" => true,
                "description" => "Dimora storica con interni moderni, situata nel cuore di Torino."
            ],
            [
                "title" => "Attico Torino Centro con Terrazzo Vista Mole",
                "max_guests" => 6,
                "rooms" => 3,
                "beds" => 2,
                "bathrooms" => 2,
                "meters_square" => 95,
                "address" => "Piazza Vittorio Veneto, 10124 Torino TO, Italy",
                "latitude" => 45.068536,
                "longitude" => 7.692927,
                "main_img" => "thumbnail_Attico_Torino_Centro_con_Terrazzo_Vista_Mole",
                "visible" => true,
                "description" => "Attico esclusivo con terrazzo, vista mozzafiato sulla Mole Antonelliana."
            ],
            [
                "title" => "Appartamento Luxury con balcone",
                "max_guests" => 4,
                "rooms" => 3,
                "beds" => 2,
                "bathrooms" => 1,
                "meters_square" => 85,
                "address" => "Via Roma, 10121 Torino TO, Italy",
                "latitude" => 45.067755,
                "longitude" => 7.682489,
                "main_img" => "thumbnail_Appartamento_Luxury_con_balcone",
                "visible" => true,
                "description" => "Appartamento di lusso con balcone, situato nella centralissima Via Roma."
            ],
        ];
    }
}
