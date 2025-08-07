<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Skill;
use App\Models\Exchange;
use App\Models\Review;
use Illuminate\Support\Facades\Hash;

class SampleDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample users
        $user1 = User::create([
            'name' => 'John Doe',
            'email' => 'john.doe@skillswap.com',
            'username' => 'johndoe',
            'password' => Hash::make('password'),
            'bio' => 'Web developer with 5 years of experience',
            'location' => 'New York, NY',
            'is_admin' => false,
            'email_verified_at' => now(),
            'member_since' => now(),
            'last_active' => now(),
        ]);

        $user2 = User::create([
            'name' => 'Jane Smith',
            'email' => 'jane.smith@skillswap.com',
            'username' => 'janesmith',
            'password' => Hash::make('password'),
            'bio' => 'Graphic designer passionate about creative work',
            'location' => 'Los Angeles, CA',
            'is_admin' => false,
            'email_verified_at' => now(),
            'member_since' => now(),
            'last_active' => now(),
        ]);

        $user3 = User::create([
            'name' => 'Mike Johnson',
            'email' => 'mike.johnson@skillswap.com',
            'username' => 'mikejohnson',
            'password' => Hash::make('password'),
            'bio' => 'Content writer and SEO specialist',
            'location' => 'Chicago, IL',
            'is_admin' => false,
            'email_verified_at' => now(),
            'member_since' => now(),
            'last_active' => now(),
        ]);

        // Create sample skills
        $skill1 = Skill::create([
            'user_id' => $user1->id,
            'name' => 'Web Development',
            'description' => 'Full-stack web development with React and Laravel',
            'category' => 'Programming',
            'level' => 'advanced',
            'is_verified' => true,
            'hourly_rate' => 50.00,
            'experience_years' => 5,
        ]);

        $skill2 = Skill::create([
            'user_id' => $user2->id,
            'name' => 'Graphic Design',
            'description' => 'Professional graphic design and branding',
            'category' => 'Design',
            'level' => 'expert',
            'is_verified' => true,
            'hourly_rate' => 45.00,
            'experience_years' => 7,
        ]);

        $skill3 = Skill::create([
            'user_id' => $user3->id,
            'name' => 'Content Writing',
            'description' => 'SEO-optimized content writing and copywriting',
            'category' => 'Writing',
            'level' => 'intermediate',
            'is_verified' => true,
            'hourly_rate' => 35.00,
            'experience_years' => 3,
        ]);

        $skill4 = Skill::create([
            'user_id' => $user1->id,
            'name' => 'Logo Design',
            'description' => 'Creative logo design and brand identity',
            'category' => 'Design',
            'level' => 'beginner',
            'is_verified' => true,
            'hourly_rate' => 25.00,
            'experience_years' => 2,
        ]);

        // Create sample exchanges
        $exchange1 = Exchange::create([
            'initiator_id' => $user1->id,
            'participant_id' => $user2->id,
            'initiator_skill_id' => $skill1->id,
            'participant_skill_id' => $skill2->id,
            'title' => 'Website Development for Logo Design',
            'description' => 'I need a professional logo for my business. In exchange, I can develop a complete website.',
            'status' => 'in_progress',
            'start_date' => now()->subDays(5),
            'estimated_hours' => 20,
            'communication_preference' => 'video',
        ]);

        $exchange2 = Exchange::create([
            'initiator_id' => $user2->id,
            'participant_id' => $user3->id,
            'initiator_skill_id' => $skill2->id,
            'participant_skill_id' => $skill3->id,
            'title' => 'Graphic Design for Content Writing',
            'description' => 'Need content writing services for my portfolio. I can provide graphic design work.',
            'status' => 'pending',
            'estimated_hours' => 15,
            'communication_preference' => 'chat',
        ]);

        $exchange3 = Exchange::create([
            'initiator_id' => $user3->id,
            'participant_id' => $user1->id,
            'initiator_skill_id' => $skill3->id,
            'participant_skill_id' => $skill4->id,
            'title' => 'Content Writing for Logo Design',
            'description' => 'Looking for a logo design for my blog. I can write content for your website.',
            'status' => 'completed',
            'start_date' => now()->subDays(10),
            'end_date' => now()->subDays(2),
            'estimated_hours' => 12,
            'actual_hours' => 10,
            'communication_preference' => 'email',
        ]);

        // Create sample reviews
        Review::create([
            'reviewer_id' => $user1->id,
            'reviewed_user_id' => $user2->id,
            'exchange_id' => $exchange1->id,
            'rating' => 5,
            'title' => 'Excellent Graphic Design Work',
            'comment' => 'Jane delivered an amazing logo design that perfectly captured my brand vision. Highly recommended!',
            'is_verified' => true,
            'is_approved' => true,
            'is_rejected' => false,
            'review_type' => 'exchange',
        ]);

        Review::create([
            'reviewer_id' => $user2->id,
            'reviewed_user_id' => $user1->id,
            'exchange_id' => $exchange1->id,
            'rating' => 4,
            'title' => 'Great Website Development',
            'comment' => 'John built a fantastic website for me. The code is clean and the site is fast. Would work with again!',
            'is_verified' => true,
            'is_approved' => true,
            'is_rejected' => false,
            'review_type' => 'exchange',
        ]);

        Review::create([
            'reviewer_id' => $user3->id,
            'reviewed_user_id' => $user1->id,
            'exchange_id' => $exchange3->id,
            'rating' => 5,
            'title' => 'Perfect Logo Design',
            'comment' => 'The logo John designed for my blog is exactly what I was looking for. Professional and creative!',
            'is_verified' => true,
            'is_approved' => false,
            'is_rejected' => false,
            'review_type' => 'exchange',
        ]);

        Review::create([
            'reviewer_id' => $user1->id,
            'reviewed_user_id' => $user3->id,
            'exchange_id' => $exchange3->id,
            'rating' => 4,
            'title' => 'Quality Content Writing',
            'comment' => 'Mike wrote excellent content for my website. SEO-optimized and engaging. Great work!',
            'is_verified' => true,
            'is_approved' => false,
            'is_rejected' => false,
            'review_type' => 'exchange',
        ]);

        $this->command->info('Sample data seeded successfully!');
    }
} 