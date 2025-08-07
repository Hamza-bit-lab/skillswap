<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Message;
use App\Models\Exchange;
use App\Models\User;

class ChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the first in_progress exchange
        $exchange = Exchange::where('status', 'in_progress')->first();
        
        if (!$exchange) {
            $this->command->info('No in_progress exchange found. Creating one first...');
            
            // Create a sample exchange
            $user1 = User::first();
            $user2 = User::skip(1)->first();
            
            if (!$user1 || !$user2) {
                $this->command->error('Need at least 2 users to create an exchange');
                return;
            }
            
            $exchange = Exchange::create([
                'initiator_id' => $user1->id,
                'participant_id' => $user2->id,
                'title' => 'Sample Exchange for Chat Testing',
                'description' => 'This is a sample exchange to test the chat functionality.',
                'status' => 'in_progress',
                'estimated_hours' => 5,
                'communication_preference' => 'Chat',
            ]);
        }
        
        // Clear existing messages for this exchange
        Message::where('exchange_id', $exchange->id)->delete();
        
        // Create sample messages
        $messages = [
            [
                'sender_id' => $exchange->initiator_id,
                'receiver_id' => $exchange->participant_id,
                'message' => 'Hi! I saw your skill listing and I\'m interested in exchanging skills.',
                'created_at' => now()->subHours(2),
            ],
            [
                'sender_id' => $exchange->participant_id,
                'receiver_id' => $exchange->initiator_id,
                'message' => 'Hello! That sounds great. What skill would you like to exchange?',
                'created_at' => now()->subHours(1)->subMinutes(45),
            ],
            [
                'sender_id' => $exchange->initiator_id,
                'receiver_id' => $exchange->participant_id,
                'message' => 'I can help you with web development. I\'m looking to learn graphic design.',
                'created_at' => now()->subHours(1)->subMinutes(30),
            ],
            [
                'sender_id' => $exchange->participant_id,
                'receiver_id' => $exchange->initiator_id,
                'message' => 'Perfect! I\'m a graphic designer and I\'ve been wanting to learn web development.',
                'created_at' => now()->subHours(1)->subMinutes(15),
            ],
            [
                'sender_id' => $exchange->initiator_id,
                'receiver_id' => $exchange->participant_id,
                'message' => 'Great! When would you like to start? I\'m available on weekends.',
                'created_at' => now()->subHours(1),
            ],
            [
                'sender_id' => $exchange->participant_id,
                'receiver_id' => $exchange->initiator_id,
                'message' => 'Weekends work perfectly for me too. Should we start this Saturday?',
                'created_at' => now()->subMinutes(45),
            ],
            [
                'sender_id' => $exchange->initiator_id,
                'receiver_id' => $exchange->participant_id,
                'message' => 'Saturday sounds good! What time works for you?',
                'created_at' => now()->subMinutes(30),
            ],
            [
                'sender_id' => $exchange->participant_id,
                'receiver_id' => $exchange->initiator_id,
                'message' => 'How about 10 AM? We can do a 2-hour session.',
                'created_at' => now()->subMinutes(15),
            ],
            [
                'sender_id' => $exchange->initiator_id,
                'receiver_id' => $exchange->participant_id,
                'message' => 'Perfect! 10 AM on Saturday it is. Looking forward to it!',
                'created_at' => now()->subMinutes(5),
            ],
        ];
        
        foreach ($messages as $messageData) {
            Message::create([
                'exchange_id' => $exchange->id,
                'sender_id' => $messageData['sender_id'],
                'receiver_id' => $messageData['receiver_id'],
                'message' => $messageData['message'],
                'message_type' => 'exchange',
                'is_read' => true,
                'created_at' => $messageData['created_at'],
                'updated_at' => $messageData['created_at'],
            ]);
        }
        
        $this->command->info('Created ' . count($messages) . ' sample messages for exchange ID: ' . $exchange->id);
    }
} 