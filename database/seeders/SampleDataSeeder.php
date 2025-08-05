<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Skill;
use Illuminate\Support\Facades\Hash;

class SampleDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample users
        $users = [
            [
                'name' => 'John Developer',
                'email' => 'john@example.com',
                'username' => 'johndev',
                'password' => Hash::make('test@example.com'),
                'bio' => 'Full-stack web developer with 5+ years of experience in Laravel, React, and Node.js. Passionate about clean code and user experience.',
                'location' => 'San Francisco, CA',
                'phone' => '+1 (555) 123-4567',
                'website' => 'https://johndev.com',
                'linkedin' => 'https://linkedin.com/in/johndev',
                'github' => 'https://github.com/johndev',
                'is_verified' => true,
            ],
            [
                'name' => 'Sarah Designer',
                'email' => 'sarah@example.com',
                'username' => 'sarahdesign',
                'password' => Hash::make('password'),
                'bio' => 'Creative UI/UX designer specializing in web and mobile applications. Expert in Figma, Adobe Creative Suite, and design systems.',
                'location' => 'New York, NY',
                'phone' => '+1 (555) 234-5678',
                'website' => 'https://sarahdesign.com',
                'linkedin' => 'https://linkedin.com/in/sarahdesign',
                'twitter' => 'https://twitter.com/sarahdesign',
                'is_verified' => true,
            ],
            [
                'name' => 'Mike Writer',
                'email' => 'mike@example.com',
                'username' => 'mikewriter',
                'password' => Hash::make('password'),
                'bio' => 'Content writer and copywriter with expertise in tech, marketing, and business content. SEO specialist and brand storyteller.',
                'location' => 'Austin, TX',
                'phone' => '+1 (555) 345-6789',
                'website' => 'https://mikewriter.com',
                'linkedin' => 'https://linkedin.com/in/mikewriter',
                'is_verified' => true,
            ],
            [
                'name' => 'Lisa Marketer',
                'email' => 'lisa@example.com',
                'username' => 'lisamarketer',
                'password' => Hash::make('password'),
                'bio' => 'Digital marketing specialist with expertise in social media, email marketing, and growth hacking. Data-driven approach to marketing.',
                'location' => 'Chicago, IL',
                'phone' => '+1 (555) 456-7890',
                'website' => 'https://lisamarketer.com',
                'linkedin' => 'https://linkedin.com/in/lisamarketer',
                'twitter' => 'https://twitter.com/lisamarketer',
                'is_verified' => true,
            ],
            [
                'name' => 'Alex Photographer',
                'email' => 'alex@example.com',
                'username' => 'alexphoto',
                'password' => Hash::make('password'),
                'bio' => 'Professional photographer specializing in product photography, portraits, and event coverage. Expert in Adobe Lightroom and Photoshop.',
                'location' => 'Los Angeles, CA',
                'phone' => '+1 (555) 567-8901',
                'website' => 'https://alexphoto.com',
                'linkedin' => 'https://linkedin.com/in/alexphoto',
                'is_verified' => true,
            ],
        ];

        foreach ($users as $userData) {
            $user = User::create($userData);
            
            // Add skills for each user
            $this->addSkillsForUser($user);
        }
    }

    private function addSkillsForUser(User $user)
    {
        $skills = [];

        switch ($user->username) {
            case 'johndev':
                $skills = [
                    [
                        'name' => 'Laravel Development',
                        'description' => 'Full-stack web development using Laravel framework. Building robust, scalable applications with modern PHP practices.',
                        'category' => 'Web Development',
                        'level' => 'Expert',
                        'experience_years' => 5,
                        'hourly_rate' => 75.00,
                        'is_verified' => true,
                        'is_featured' => true,
                    ],
                    [
                        'name' => 'React Development',
                        'description' => 'Frontend development with React.js. Building interactive user interfaces and single-page applications.',
                        'category' => 'Web Development',
                        'level' => 'Advanced',
                        'experience_years' => 4,
                        'hourly_rate' => 70.00,
                        'is_verified' => true,
                    ],
                    [
                        'name' => 'API Development',
                        'description' => 'RESTful API development and integration. Experience with GraphQL, authentication, and third-party integrations.',
                        'category' => 'Backend Development',
                        'level' => 'Expert',
                        'experience_years' => 4,
                        'hourly_rate' => 80.00,
                        'is_verified' => true,
                    ],
                ];
                break;

            case 'sarahdesign':
                $skills = [
                    [
                        'name' => 'UI/UX Design',
                        'description' => 'User interface and user experience design for web and mobile applications. Creating intuitive and beautiful user experiences.',
                        'category' => 'Design',
                        'level' => 'Expert',
                        'experience_years' => 6,
                        'hourly_rate' => 85.00,
                        'is_verified' => true,
                        'is_featured' => true,
                    ],
                    [
                        'name' => 'Logo Design',
                        'description' => 'Professional logo design and brand identity creation. Creating memorable and impactful brand symbols.',
                        'category' => 'Design',
                        'level' => 'Advanced',
                        'experience_years' => 5,
                        'hourly_rate' => 60.00,
                        'is_verified' => true,
                    ],
                    [
                        'name' => 'Figma Design',
                        'description' => 'UI design and prototyping using Figma. Creating interactive prototypes and design systems.',
                        'category' => 'Design',
                        'level' => 'Expert',
                        'experience_years' => 4,
                        'hourly_rate' => 70.00,
                        'is_verified' => true,
                    ],
                ];
                break;

            case 'mikewriter':
                $skills = [
                    [
                        'name' => 'Content Writing',
                        'description' => 'Professional content writing for websites, blogs, and marketing materials. SEO-optimized content that engages readers.',
                        'category' => 'Writing',
                        'level' => 'Expert',
                        'experience_years' => 7,
                        'hourly_rate' => 50.00,
                        'is_verified' => true,
                        'is_featured' => true,
                    ],
                    [
                        'name' => 'Copywriting',
                        'description' => 'Persuasive copywriting for marketing campaigns, advertisements, and sales materials. Converting readers into customers.',
                        'category' => 'Writing',
                        'level' => 'Advanced',
                        'experience_years' => 5,
                        'hourly_rate' => 65.00,
                        'is_verified' => true,
                    ],
                    [
                        'name' => 'Technical Writing',
                        'description' => 'Technical documentation, user manuals, and API documentation. Making complex information accessible.',
                        'category' => 'Writing',
                        'level' => 'Intermediate',
                        'experience_years' => 3,
                        'hourly_rate' => 45.00,
                        'is_verified' => true,
                    ],
                ];
                break;

            case 'lisamarketer':
                $skills = [
                    [
                        'name' => 'Social Media Marketing',
                        'description' => 'Comprehensive social media marketing strategies for businesses. Content creation, community management, and paid advertising.',
                        'category' => 'Marketing',
                        'level' => 'Expert',
                        'experience_years' => 6,
                        'hourly_rate' => 60.00,
                        'is_verified' => true,
                        'is_featured' => true,
                    ],
                    [
                        'name' => 'Email Marketing',
                        'description' => 'Email marketing campaigns, automation, and lead nurturing. Building and maintaining email lists for business growth.',
                        'category' => 'Marketing',
                        'level' => 'Advanced',
                        'experience_years' => 4,
                        'hourly_rate' => 55.00,
                        'is_verified' => true,
                    ],
                    [
                        'name' => 'SEO Optimization',
                        'description' => 'Search engine optimization for websites. Keyword research, on-page optimization, and link building strategies.',
                        'category' => 'Marketing',
                        'level' => 'Intermediate',
                        'experience_years' => 3,
                        'hourly_rate' => 45.00,
                        'is_verified' => true,
                    ],
                ];
                break;

            case 'alexphoto':
                $skills = [
                    [
                        'name' => 'Product Photography',
                        'description' => 'Professional product photography for e-commerce and marketing. High-quality images that showcase products effectively.',
                        'category' => 'Photography',
                        'level' => 'Expert',
                        'experience_years' => 8,
                        'hourly_rate' => 75.00,
                        'is_verified' => true,
                        'is_featured' => true,
                    ],
                    [
                        'name' => 'Portrait Photography',
                        'description' => 'Professional portrait photography for individuals and businesses. Creating compelling headshots and personal branding images.',
                        'category' => 'Photography',
                        'level' => 'Advanced',
                        'experience_years' => 6,
                        'hourly_rate' => 65.00,
                        'is_verified' => true,
                    ],
                    [
                        'name' => 'Photo Editing',
                        'description' => 'Professional photo editing and retouching using Adobe Lightroom and Photoshop. Color correction and image enhancement.',
                        'category' => 'Photography',
                        'level' => 'Expert',
                        'experience_years' => 7,
                        'hourly_rate' => 55.00,
                        'is_verified' => true,
                    ],
                ];
                break;
        }

        foreach ($skills as $skillData) {
            $skillData['user_id'] = $user->id;
            Skill::create($skillData);
        }
    }
} 