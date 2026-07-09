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
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Engr. Juan Dela Cruz',
                'position' => 'Assistant Campus Director',
                'photo' => 'photos/officials/juan_dela_cruz.jpg',
                'order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Prof. Ana Reyes',
                'position' => 'Dean of Academic Affairs',
                'photo' => 'photos/officials/ana_reyes.jpg',
                'order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
