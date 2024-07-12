<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $icons = [
            [
                'name' => 'set di cortesia',
                'icon' => 'beauty-salon.svg'
            ],
            [
                'name' => 'lavastoviglie',
                'icon' => 'dishwasher-gen-outline-rounded.svg'
            ],
            [
                'name' => 'frigorifero',
                'icon' => 'fridge-line-duotone.svg'
            ],
            [
                'name' => 'phon',
                'icon' => 'hair-dryer.svg'
            ],
            [
                'name' => 'bollitore',
                'icon' => 'kettle-steam-outline.svg'
            ],
            [
                'name' => 'microonde',
                'icon' => 'microwave.svg'
            ],
            [
                'name' => 'riscaldamento',
                'icon' => 'radiator.svg'
            ],
            [
                'name' => 'asciugamani',
                'icon' => 'towel.svg'
            ],
            [
                'name' => 'condizionatore',
                'icon' => 'air-conditioner.svg'
            ],
            [
                'name' => 'parcheggio',
                'icon' => 'parking.svg'
            ],
            [
                'name' => 'lenzuola',
                'icon' => 'lenzuola.svg'
            ],
            [
                'name' => 'tv',
                'icon' => 'tv.svg'
            ],
            [
                'name' => 'wifi',
                'icon' => 'wifi.svg'
            ],
            [
                'name' => 'balcone',
                'icon' => 'balcony.svg'
            ],
            [
                'name' => 'prodotti pulizia',
                'icon' => 'cleaning-outline.svg'
            ],
            [
                'name' => 'macchina del caffè',
                'icon' => 'coffee-machine.svg'
            ],
            [
                'name' => 'ferro da stiro',
                'icon' => 'ironing.svg'
            ],
            [
                'name' => 'serratura di sicurezza',
                'icon' => 'key.svg'
            ],
            [
                'name' => 'cucina attrezzata',
                'icon' => 'pot.svg'
            ],
            [
                'name' => 'lavatrice',
                'icon' => 'washing-machine.svg'
            ],
        ];

        foreach ($icons as $icon) {
            $newService = new Service();
            $newService->fill($icon);
            $newService->save();
        }
    }
}
