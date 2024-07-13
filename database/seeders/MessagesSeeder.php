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
                'text' => 'Hello, this is a sample message from John Doe.'
            ],
            [
                'email' => 'jane.smith@example.com',
                'name' => 'Jane Smith',
                'text' => 'Hi, Jane Smith here. Just wanted to say hello!'
            ],
            [
                'email' => 'alice.johnson@example.com',
                'name' => 'Alice Johnson',
                'text' => 'Greetings from Alice Johnson!'
            ],
            [
                'email' => 'bob.brown@example.com',
                'name' => 'Bob Brown',
                'text' => 'Bob Brown sending a message your way.'
            ],
            [
                'email' => 'carol.white@example.com',
                'name' => 'Carol White',
                'text' => 'Carol White here with a quick note.'
            ],
            [
                'email' => 'david.jones@example.com',
                'name' => 'David Jones',
                'text' => 'David Jones checking in.'
            ],
            [
                'email' => 'eva.green@example.com',
                'name' => 'Eva Green',
                'text' => 'A message from Eva Green.'
            ],
            [
                'email' => 'frank.miller@example.com',
                'name' => 'Frank Miller',
                'text' => 'Frank Miller with a message for you.'
            ],
            [
                'email' => 'grace.wilson@example.com',
                'name' => 'Grace Wilson',
                'text' => 'Grace Wilson sending her regards.'
            ],
            [
                'email' => 'henry.moore@example.com',
                'name' => 'Henry Moore',
                'text' => 'Henry Moore here. Just saying hi!'
            ],
            [
                'email' => 'irene.taylor@example.com',
                'name' => 'Irene Taylor',
                'text' => 'Irene Taylor with a quick message.'
            ],
            [
                'email' => 'jack.anderson@example.com',
                'name' => 'Jack Anderson',
                'text' => 'Jack Anderson sending a message.'
            ],
            [
                'email' => 'kate.thomas@example.com',
                'name' => 'Kate Thomas',
                'text' => 'Kate Thomas with a brief note.'
            ],
            [
                'email' => 'leo.martin@example.com',
                'name' => 'Leo Martin',
                'text' => 'Leo Martin here. Just a quick message.'
            ],
            [
                'email' => 'maria.clark@example.com',
                'name' => 'Maria Clark',
                'text' => 'Maria Clark sending her regards.'
            ],
            [
                'email' => 'nick.lewis@example.com',
                'name' => 'Nick Lewis',
                'text' => 'Nick Lewis with a message.'
            ],
            [
                'email' => 'olivia.walker@example.com',
                'name' => 'Olivia Walker',
                'text' => 'Olivia Walker checking in.'
            ],
            [
                'email' => 'paul.king@example.com',
                'name' => 'Paul King',
                'text' => 'Paul King here with a message.'
            ],
            [
                'email' => 'quincy.harris@example.com',
                'name' => 'Quincy Harris',
                'text' => 'Quincy Harris saying hello.'
            ],
            [
                'email' => 'rachel.young@example.com',
                'name' => 'Rachel Young',
                'text' => 'Rachel Young sending a note.'
            ]
        ];
        
        
        foreach ($messages as $message) {
            $newMessage = new Message();
            $newMessage->fill($message);
            $newMessage->save();
        }
    }
}
