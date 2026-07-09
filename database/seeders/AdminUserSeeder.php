<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'admin@tupv.edu.ph'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'), // Change this password after first login
                'is_admin' => true,
            ]
        );
    }
}