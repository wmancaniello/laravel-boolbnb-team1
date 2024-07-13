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
                
            ],
            
        ];
        
        foreach ($messages as $message) {
            $newMessage = new Message();
            $newMessage->fill($message);
            $newMessage->save();
        }
    }
}
