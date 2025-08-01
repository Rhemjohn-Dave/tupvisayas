<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Announcement;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Call other seeders
        $this->call([
            AdminUserSeeder::class,
        ]);

        // Create test categories
        $categories = [
            ['name' => 'Academic', 'slug' => 'academic'],
            ['name' => 'Administrative', 'slug' => 'administrative'],
            ['name' => 'Events', 'slug' => 'events'],
            ['name' => 'General', 'slug' => 'general'],
        ];

        foreach ($categories as $categoryData) {
            Category::updateOrCreate(
                ['slug' => $categoryData['slug']],
                $categoryData
            );
        }

        // Create test announcements
        $announcements = [
            [
                'title' => 'Welcome to TUP Visayas Campus',
                'content' => '<p>Welcome to the Technological University of the Philippines Visayas Campus. We are committed to providing quality education and fostering academic excellence.</p><p>Our campus offers various programs designed to prepare students for successful careers in technology and engineering fields.</p>',
                'category_id' => Category::where('slug', 'general')->first()->id,
            ],
            [
                'title' => 'Academic Calendar Update',
                'content' => '<p>Please be informed that the academic calendar for the current semester has been updated. All students are advised to check the new schedule and important dates.</p><p>For more information, please contact the Academic Affairs Office.</p>',
                'category_id' => Category::where('slug', 'academic')->first()->id,
            ],
            [
                'title' => 'Student Organization Fair',
                'content' => '<p>Join us for the annual Student Organization Fair where you can learn about various student clubs and organizations on campus.</p><p>This event will be held at the main auditorium from 9:00 AM to 4:00 PM.</p>',
                'category_id' => Category::where('slug', 'events')->first()->id,
            ],
        ];

        foreach ($announcements as $announcementData) {
            Announcement::updateOrCreate(
                ['title' => $announcementData['title']],
                $announcementData
            );
        }
    }
}
