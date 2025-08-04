<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@skillswap.com',
            'password' => Hash::make('password'),
            'username' => 'admin',
            'is_admin' => true,
            'is_verified' => true,
            'email_verified_at' => now(),
            'member_since' => now(),
            'last_active' => now(),
        ]);
    }
}
