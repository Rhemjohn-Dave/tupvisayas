<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OfficialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('officials')->insert([
            [
                'name' => 'Dr. Maria Santos',
                'position' => 'Campus Director',
                'photo' => 'photos/officials/maria_santos.jpg',
<<<<<<< HEAD
                'order' => 1,
=======
                'bio' => 'Dr. Maria Santos is the current Campus Director of TUP Visayas.',
                'order' => 1,
                'social_links' => json_encode(['facebook' => 'https://facebook.com/maria.santos']),
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Engr. Juan Dela Cruz',
                'position' => 'Assistant Campus Director',
                'photo' => 'photos/officials/juan_dela_cruz.jpg',
<<<<<<< HEAD
                'order' => 2,
=======
                'bio' => 'Engr. Juan Dela Cruz assists in the administration of TUP Visayas.',
                'order' => 2,
                'social_links' => json_encode(['linkedin' => 'https://linkedin.com/in/juan.delacruz']),
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Prof. Ana Reyes',
                'position' => 'Dean of Academic Affairs',
                'photo' => 'photos/officials/ana_reyes.jpg',
<<<<<<< HEAD
                'order' => 3,
=======
                'bio' => 'Prof. Ana Reyes oversees academic programs at TUP Visayas.',
                'order' => 3,
                'social_links' => null,
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
