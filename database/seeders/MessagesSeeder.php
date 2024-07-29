<?php

namespace Database\Seeders;

use App\Models\Message;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MessagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $messages = [
            [
                'email' => 'john.doe@example.com',
                'name' => 'John Doe',
                'text' => 'Hello, this is a sample message from John Doe.',
                'flat_id' => rand(1, 49)
            ],
            [
                'email' => 'jane.smith@example.com',
                'name' => 'Jane Smith',
                'text' => 'Hi, Jane Smith here. Just wanted to say hello!',
                'flat_id' => rand(1, 49)
            ],
            [
                'email' => 'alice.johnson@example.com',
                'name' => 'Alice Johnson',
                'text' => 'Greetings from Alice Johnson!',
                'flat_id' => rand(1, 49)
            ],
            [
                'email' => 'bob.brown@example.com',
                'name' => 'Bob Brown',
                'text' => 'Bob Brown sending a message your way.',
                'flat_id' => rand(1, 49)
            ],
            [
                'email' => 'carol.white@example.com',
                'name' => 'Carol White',
                'text' => 'Carol White here with a quick note.',
                'flat_id' => rand(1, 49)
            ],
            [
                'email' => 'david.jones@example.com',
                'name' => 'David Jones',
                'text' => 'David Jones checking in.',
                'flat_id' => rand(1, 49)
            ],
            [
                'email' => 'eva.green@example.com',
                'name' => 'Eva Green',
                'text' => 'A message from Eva Green.',
                'flat_id' => rand(1, 49)
            ],
            [
                'email' => 'frank.miller@example.com',
                'name' => 'Frank Miller',
                'text' => 'Frank Miller with a message for you.',
                'flat_id' => rand(1, 49)
            ],
            [
                'email' => 'grace.wilson@example.com',
                'name' => 'Grace Wilson',
                'text' => 'Grace Wilson sending her regards.',
                'flat_id' => rand(1, 49)
            ],
            [
                'email' => 'henry.moore@example.com',
                'name' => 'Henry Moore',
                'text' => 'Henry Moore here. Just saying hi!',
                'flat_id' => rand(1, 49)
            ],
            [
                'email' => 'irene.taylor@example.com',
                'name' => 'Irene Taylor',
                'text' => 'Irene Taylor with a quick message.',
                'flat_id' => rand(1, 49)
            ],
            [
                'email' => 'jack.anderson@example.com',
                'name' => 'Jack Anderson',
                'text' => 'Jack Anderson sending a message.',
                'flat_id' => rand(1, 49)
            ],
            [
                'email' => 'kate.thomas@example.com',
                'name' => 'Kate Thomas',
                'text' => 'Kate Thomas with a brief note.',
                'flat_id' => rand(1, 49)
            ],
            [
                'email' => 'leo.martin@example.com',
                'name' => 'Leo Martin',
                'text' => 'Leo Martin here. Just a quick message.',
                'flat_id' => rand(1, 49)
            ],
            [
                'email' => 'maria.clark@example.com',
                'name' => 'Maria Clark',
                'text' => 'Maria Clark sending her regards.',
                'flat_id' => rand(1, 49)
            ],
            [
                'email' => 'nick.lewis@example.com',
                'name' => 'Nick Lewis',
                'text' => 'Nick Lewis with a message.',
                'flat_id' => rand(1, 49)
            ],
            [
                'email' => 'olivia.walker@example.com',
                'name' => 'Olivia Walker',
                'text' => 'Olivia Walker checking in.',
                'flat_id' => rand(1, 49)
            ],
            [
                'email' => 'paul.king@example.com',
                'name' => 'Paul King',
                'text' => 'Paul King here with a message.',
                'flat_id' => rand(1, 49)
            ],
            [
                'email' => 'quincy.harris@example.com',
                'name' => 'Quincy Harris',
                'text' => 'Quincy Harris saying hello.',
                'flat_id' => rand(1, 49)
            ],
            [
                'email' => 'rachel.young@example.com',
                'name' => 'Rachel Young',
                'text' => 'Rachel Young sending a note.',
                'flat_id' => rand(1, 49)
            ]
        ];
        
        
        
        foreach ($messages as $message) {
            $newMessage = new Message();
            $newMessage->fill($message);
            $newMessage->save();
        }
    }
}
