<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'surname' => '',
                'first_name' => '',
                'phone' => '09176943827',
                'email' => fake()->unique()->safeEmail(),
                // 'email_verified_at' => now(),            
            ],
            [
                'surname' => '',
                'first_name' => '',
                'phone' => '08126548694',
                'email' => fake()->unique()->safeEmail(),
                // 'email_verified_at' => now(),            
            ],
            [
                'surname' => '',
                'first_name' => '',
                'phone' => fake()->unique()->phoneNumber,
                'email' => fake()->unique()->safeEmail(),
                // 'email_verified_at' => now(),            
            ],
            [
                'surname' => '',
                'first_name' => '',
                'phone' => fake()->unique()->phoneNumber,
                'email' => fake()->unique()->safeEmail(),
                // 'email_verified_at' => now(),            
            ],
            [
                'surname' => '',
                'first_name' => '',
                'phone' => '08095867439',
                'email' => fake()->unique()->safeEmail(),
                // 'email_verified_at' => now(),            
            ],
        ];

        foreach($users as $user){
            User::create($user);
        }
    }
}
