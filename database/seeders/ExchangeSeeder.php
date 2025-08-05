<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Exchange;
use App\Models\User;
use App\Models\Skill;
use Carbon\Carbon;

class ExchangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure you have users and skills in the database
        $users = User::pluck('id')->toArray();
        $skills = Skill::pluck('id')->toArray();

        if (empty($users) || empty($skills)) {
            $this->command->warn('No users or skills found! Please seed users and skills first.');
            return;
        }

        $statuses = ['pending', 'in_progress', 'completed', 'cancelled', 'disputed'];
        $locations = ['Remote', 'Onsite', 'Hybrid'];
        $communications = ['Email', 'Phone', 'Chat', 'Video Call'];

        for ($i = 1; $i <= 10; $i++) {
            $initiatorId = $users[array_rand($users)];
            $participantId = $users[array_rand($users)];
            while ($participantId === $initiatorId) {
                $participantId = $users[array_rand($users)];
            }

            $startDate = Carbon::now()->subDays(rand(1, 30));
            $endDate = rand(0, 1) ? $startDate->copy()->addDays(rand(1, 7)) : null;

            Exchange::create([
                'initiator_id' => $initiatorId,
                'participant_id' => $participantId,
                'initiator_skill_id' => $skills[array_rand($skills)],
                'participant_skill_id' => rand(0, 1) ? $skills[array_rand($skills)] : null,
                'title' => 'Exchange ' . $i,
                'description' => 'This is a sample description for Exchange ' . $i,
                'status' => $statuses[array_rand($statuses)],
                'start_date' => $startDate,
                'end_date' => $endDate,
                'estimated_hours' => rand(1, 40),
                'actual_hours' => rand(0, 40),
                'terms' => json_encode([
                    'payment' => 'In skill trade',
                    'deadline' => 'Flexible',
                    'notes' => 'Both parties must agree on completion'
                ]),
                'is_featured' => (bool)rand(0, 1),
                'is_urgent' => (bool)rand(0, 1),
                'budget_range' => rand(0, 1) ? '$100 - $500' : null,
                'location_preference' => $locations[array_rand($locations)],
                'communication_preference' => $communications[array_rand($communications)],
            ]);
        }
    }
}
