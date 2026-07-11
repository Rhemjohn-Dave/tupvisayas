<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        $password = env('ADMIN_SEED_PASSWORD');

        if (! is_string($password) || $password === '') {
            $this->command?->warn('ADMIN_SEED_PASSWORD is not set — skipping admin user seed.');

            return;
        }

        $user = User::updateOrCreate(
            ['email' => 'admin@tupv.edu.ph'],
            [
                'name' => 'Admin',
                'password' => Hash::make($password),
            ]
        );

        $user->forceFill(['is_admin' => true])->save();

        if (method_exists($user, 'syncRoles')) {
            $user->syncRoles(['Administrator']);
        }
    }
}
