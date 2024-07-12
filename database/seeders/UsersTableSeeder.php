<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'sabino',
                'surname' => 'olivieri',
                'date_of_birth' => '1996-02-28',
                'email' => 'sabino.olivieri.28@gmail.com',
                'password' => 'qwertyuiop',
            ],

            [
                'name' => 'william',
                'surname' => 'mancaniello',
                'date_of_birth' => '1998-01-31',
                'email' => 'wmancaniello@gmail.com',
                'password' => 'qwertyuiop',
            ],

            [
                'name' => 'ylenia',
                'surname' => 'pregnolato',
                'date_of_birth' => '1994-09-02',
                'email' => 'yleniapregnolato@gmail.com',
                'password' => 'qwertyuiop',
            ],

            
            [
                'name' => 'luca',
                'surname' => 'sensini',
                'date_of_birth' => '1997-09-26',
                'email' => 'lucasensini1@gmail.com',
                'password' => 'qwertyuiop',
            ],

            [
                'name' => 'alessio',
                'surname' => 'caringella',
                'date_of_birth' => '2000-06-13',
                'email' => 'private_a.a.c@icloud.com',
                'password' => 'qwertyuiop',
            ],

        ];

        foreach ($users as $user) {
            $newUser = new User();
            $newUser->fill($user);
            $newUser->save();
        }


    }
}
