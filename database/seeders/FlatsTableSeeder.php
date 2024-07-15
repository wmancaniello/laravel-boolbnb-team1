<?php

namespace Database\Seeders;

use App\Models\Flat;
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
                "user_id" => 1,
                "title" => "GRAN MADRE Suite elegante con terrazzo",
                "max_guests" => 4,
                "rooms" => 3,
                "beds" => 2,
                "bathrooms" => 2,
                "meters_square" => 90,
                "address" => "Piazza Gran Madre di Dio, 10131 Torino TO, Italy",
                "latitude" => 45.066365,
                "longitude" => 7.693069,
                "main_img" => "flats_img/thumbnail_GRAN_MADRE_Suite_elegante_con_terrazzo.webp",
                "visible" => true,
                "description" => "Elegante suite con terrazzo, situata vicino alla storica Gran Madre."
            ],
            [
                "user_id" => 2,
                "title" => "Elegante appartamento con terrazzino vista MOLE",
                "max_guests" => 3,
                "rooms" => 2,
                "beds" => 1,
                "bathrooms" => 1,
                "meters_square" => 75,
                "address" => "Via Montebello, 10124 Torino TO, Italy",
                "latitude" => 45.069167,
                "longitude" => 7.692576,
                "main_img" => "flats_img/thumbnail_Elegante_appartamento_con_terrazzino_vista_MOLE.webp",
                "visible" => true,
                "description" => "Appartamento elegante con terrazzino, splendida vista sulla Mole Antonelliana."
            ],
            [
                "user_id" => 3,
                "title" => "Dimora Novecento",
                "max_guests" => 5,
                "rooms" => 4,
                "beds" => 2,
                "bathrooms" => 2,
                "meters_square" => 110,
                "address" => "Via Po, 10123 Torino TO, Italy",
                "latitude" => 45.068267,
                "longitude" => 7.686856,
                "main_img" => "flats_img/thumbnail_Dimora_Novecento.webp",
                "visible" => true,
                "description" => "Dimora storica con interni moderni, situata nel cuore di Torino."
            ],
            [
                "user_id" => 4,
                "title" => "Attico Torino Centro con Terrazzo Vista Mole",
                "max_guests" => 6,
                "rooms" => 3,
                "beds" => 2,
                "bathrooms" => 2,
                "meters_square" => 95,
                "address" => "Piazza Vittorio Veneto, 10124 Torino TO, Italy",
                "latitude" => 45.068536,
                "longitude" => 7.692927,
                "main_img" => "flats_img/thumbnail_Attico_Torino_Centro_con_Terrazzo_Vista_Mole.webp",
                "visible" => true,
                "description" => "Attico esclusivo con terrazzo, vista mozzafiato sulla Mole Antonelliana."
            ],
            [
                "user_id" => 5,
                "title" => "Appartamento Luxury con balcone",
                "max_guests" => 4,
                "rooms" => 3,
                "beds" => 2,
                "bathrooms" => 1,
                "meters_square" => 85,
                "address" => "Via Roma, 10121 Torino TO, Italy",
                "latitude" => 45.067755,
                "longitude" => 7.682489,
                "main_img" => "flats_img/thumbnail_Appartamento_Luxury_con_balcone.webp",
                "visible" => true,
                "description" => "Appartamento di lusso con balcone, situato nella centralissima Via Roma."
            ],
            [
                "user_id" => 1,
                "title" => "Atlana",
                "max_guests" => 4,
                "rooms" => 3,
                "beds" => 2,
                "bathrooms" => 2,
                "meters_square" => 85,
                "address" => "Calle Larga XXII Marzo, 2091, 30124 Venezia VE, Italy",
                "latitude" => 45.4338,
                "longitude" => 12.3346,
                "main_img" => "flats_img/thumbnail_Atlana.webp",
                "visible" => true,
                "description" => "Elegante appartamento moderno nel cuore di Venezia, perfetto per famiglie o gruppi di amici."
            ],
            [
                "user_id" => 2,
                "title" => "Ca Bella Vista",
                "max_guests" => 6,
                "rooms" => 4,
                "beds" => 2,
                "bathrooms" => 2,
                "meters_square" => 110,
                "address" => "Fondamenta delle Zattere, 1401, 30123 Venezia VE, Italy",
                "latitude" => 45.4266,
                "longitude" => 12.3247,
                "main_img" => "flats_img/thumbnail_Ca_Bella_Vista.webp",
                "visible" => true,
                "description" => "Appartamento spazioso con vista mozzafiato sui canali, ideale per un soggiorno di lusso a Venezia."
            ],
            [
                "user_id" => 3,
                "title" => "Ca Rolina",
                "max_guests" => 3,
                "rooms" => 2,
                "beds" => 1,
                "bathrooms" => 1,
                "meters_square" => 70,
                "address" => "Strada Nova, 4367, 30121 Venezia VE, Italy",
                "latitude" => 45.4431,
                "longitude" => 12.3266,
                "main_img" => "flats_img/thumbnail_Ca_Rolina.jpg",
                "visible" => true,
                "description" => "Accogliente appartamento nel vivace quartiere di Cannaregio, perfetto per una coppia o una piccola famiglia."
            ],
            [
                "user_id" => 4,
                "title" => "Canal Dream",
                "max_guests" => 5,
                "rooms" => 3,
                "beds" => 2,
                "bathrooms" => 1,
                "meters_square" => 90,
                "address" => "Riva degli Schiavoni, 4187, 30122 Venezia VE, Italy",
                "latitude" => 45.4343,
                "longitude" => 12.3430,
                "main_img" => "flats_img/thumbnail_Canal_Dream.webp",
                "visible" => true,
                "description" => "Appartamento con una vista panoramica sulla laguna, ideale per un soggiorno rilassante e romantico."
            ],
            [
                "user_id" => 5,
                "title" => "Tintoretto",
                "max_guests" => 2,
                "rooms" => 2,
                "beds" => 1,
                "bathrooms" => 1,
                "meters_square" => 60,
                "address" => "Calle della Mandola, 3755, 30124 Venezia VE, Italy",
                "latitude" => 45.4366,
                "longitude" => 12.3351,
                "main_img" => "flats_img/thumbnail_Tintoretto.webp",
                "visible" => true,
                "description" => "Elegante appartamento per due nel cuore di San Marco, ideale per una fuga romantica a Venezia."
            ],
            [
                "user_id" => 1,
                "title" => "Cottage",
                "max_guests" => 4,
                "rooms" => 3,
                "beds" => 2,
                "bathrooms" => 1,
                "meters_square" => 75,
                "address" => "Via del Corso, 1, 50122 Firenze FI, Italy",
                "latitude" => 43.7705,
                "longitude" => 11.2569,
                "main_img" => "flats_img/thumbnail_Cottage.webp",
                "visible" => true,
                "description" => "Accogliente cottage situato nel cuore di Firenze, perfetto per famiglie che vogliono esplorare la città."
            ],
            [
                "user_id" => 2,
                "title" => "Dame di Toscana",
                "max_guests" => 6,
                "rooms" => 4,
                "beds" => 2,
                "bathrooms" => 2,
                "meters_square" => 100,
                "address" => "Via de' Benci, 10, 50122 Firenze FI, Italy",
                "latitude" => 43.7687,
                "longitude" => 11.2610,
                "main_img" => "flats_img/thumbnail_Dame_di_Toscana.webp",
                "visible" => true,
                "description" => "Appartamento elegante e spazioso nel cuore di Firenze, ideale per famiglie o gruppi di amici."
            ],
            [
                "user_id" => 3,
                "title" => "Tosca",
                "max_guests" => 2,
                "rooms" => 1,
                "beds" => 1,
                "bathrooms" => 1,
                "meters_square" => 50,
                "address" => "Via Ghibellina, 90, 50122 Firenze FI, Italy",
                "latitude" => 43.7699,
                "longitude" => 11.2634,
                "main_img" => "flats_img/thumbnail_Tosca.webp",
                "visible" => true,
                "description" => "Affascinante monolocale situato vicino al Duomo, perfetto per coppie in visita a Firenze."
            ],
            [
                "user_id" => 4,
                "title" => "L'Arco di San Pierino",
                "max_guests" => 4,
                "rooms" => 3,
                "beds" => 2,
                "bathrooms" => 2,
                "meters_square" => 85,
                "address" => "Via dei Calzaiuoli, 2, 50122 Firenze FI, Italy",
                "latitude" => 43.7720,
                "longitude" => 11.2561,
                "main_img" => "flats_img/thumbnail_L_Arco_di_San_Pierino.webp",
                "visible" => true,
                "description" => "Elegante appartamento nel centro storico di Firenze, a pochi passi dalle principali attrazioni."
            ],
            [
                "user_id" => 5,
                "title" => "Chiara",
                "max_guests" => 5,
                "rooms" => 4,
                "beds" => 3,
                "bathrooms" => 2,
                "meters_square" => 95,
                "address" => "Piazza del Duomo, 4, 50122 Firenze FI, Italy",
                "latitude" => 43.7735,
                "longitude" => 11.2558,
                "main_img" => "flats_img/thumbnail_Chiara.webp",
                "visible" => true,
                "description" => "Appartamento spazioso con vista sulla cattedrale, perfetto per famiglie o gruppi."
            ],
            [
                "user_id" => 1,
                "title" => "Ambrogio",
                "max_guests" => 4,
                "rooms" => 2,
                "beds" => 2,
                "bathrooms" => 1,
                "meters_square" => 75,
                "address" => "Via San Damiano, 2, 20122 Milano MI, Italy",
                "latitude" => 45.4668,
                "longitude" => 9.2017,
                "main_img" => "flats_img/thumbnail_Ambrogio.webp",
                "visible" => true,
                "description" => "Appartamento moderno nel centro di Milano, perfetto per chi vuole esplorare la città."
            ],
            [
                "user_id" => 2,
                "title" => "Bramante",
                "max_guests" => 3,
                "rooms" => 2,
                "beds" => 1,
                "bathrooms" => 1,
                "meters_square" => 70,
                "address" => "Corso Magenta, 24, 20123 Milano MI, Italy",
                "latitude" => 45.4642,
                "longitude" => 9.1768,
                "main_img" => "flats_img/thumbnail_Bramante.webp",
                "visible" => true,
                "description" => "Appartamento accogliente situato vicino a Santa Maria delle Grazie, perfetto per coppie."
            ],
            [
                "user_id" => 3,
                "title" => "Leonardo",
                "max_guests" => 2,
                "rooms" => 1,
                "beds" => 1,
                "bathrooms" => 1,
                "meters_square" => 55,
                "address" => "Via Monte Napoleone, 10, 20121 Milano MI, Italy",
                "latitude" => 45.4687,
                "longitude" => 9.1940,
                "main_img" => "flats_img/thumbnail_Leonardo.webp",
                "visible" => true,
                "description" => "Lussuoso monolocale nel cuore del Quadrilatero della Moda, ideale per una coppia."
            ],
            [
                "user_id" => 4,
                "title" => "Michelangelo",
                "max_guests" => 5,
                "rooms" => 3,
                "beds" => 2,
                "bathrooms" => 2,
                "meters_square" => 95,
                "address" => "Piazza della Scala, 6, 20121 Milano MI, Italy",
                "latitude" => 45.4665,
                "longitude" => 9.1891,
                "main_img" => "flats_img/thumbnail_Michelangelo.webp",
                "visible" => true,
                "description" => "Spazioso appartamento con vista su Piazza della Scala, perfetto per famiglie."
            ],
            [
                "user_id" => 5,
                "title" => "Raffaello",
                "max_guests" => 4,
                "rooms" => 3,
                "beds" => 2,
                "bathrooms" => 1,
                "meters_square" => 80,
                "address" => "Via Brera, 28, 20121 Milano MI, Italy",
                "latitude" => 45.4703,
                "longitude" => 9.1881,
                "main_img" => "flats_img/thumbnail_Raffaello.webp",
                "visible" => true,
                "description" => "Elegante appartamento nel quartiere Brera, ideale per esplorare le attrazioni culturali di Milano."
            ],
        ];
        

        foreach ($flats as $flat) {
            $newFlat = new Flat();
            $newFlat->fill($flat);
            $newFlat->save();
        };
    }
}
