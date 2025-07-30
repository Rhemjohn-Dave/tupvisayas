<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Announcement;
use Illuminate\Support\Str;

class AddSlugsToExistingAnnouncementsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $announcements = Announcement::whereNull('slug')->orWhere('slug', '')->get();

        foreach ($announcements as $item) {
            $baseSlug = Str::slug($item->title);
            $slug = $baseSlug;
            $counter = 1;

            // Check if slug already exists and make it unique
            while (Announcement::where('slug', $slug)->where('id', '!=', $item->id)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }

            $item->update(['slug' => $slug]);
        }
    }
}
