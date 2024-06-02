<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = new User();
        $admin->surname = 'Super';
        $admin->first_name = 'Admin';
        $admin->phone = '08012345678';
        $admin->email = 'superadmin@filament-test.com';
        $admin->email_verified_at = now();
        $admin->user_type = 'admin';
        $admin->is_admin = true;
        $admin->admin_level = 1;
        $admin->is_active = true;
        $admin->save();
    }
}
