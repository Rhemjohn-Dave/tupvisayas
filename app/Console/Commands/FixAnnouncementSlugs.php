<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Announcement;
use Illuminate\Support\Str;

class FixAnnouncementSlugs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'announcements:fix-slugs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix announcement slugs for existing announcements';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $announcements = Announcement::whereNull('slug')->orWhere('slug', '')->get();

        if ($announcements->count() === 0) {
            $this->info('No announcements found without slugs.');
            return;
        }

        $this->info("Found {$announcements->count()} announcements without slugs. Fixing...");

        foreach ($announcements as $announcement) {
            // Clean the title and generate slug
            $cleanTitle = strip_tags($announcement->title);
            $cleanTitle = html_entity_decode($cleanTitle, ENT_QUOTES, 'UTF-8');
            $baseSlug = Str::slug($cleanTitle);

            // If slug is still empty, use a fallback
            if (empty($baseSlug)) {
                $baseSlug = 'announcement-' . $announcement->id;
            }

            $slug = $baseSlug;
            $counter = 1;

            // Make sure slug is unique
            while (Announcement::where('slug', $slug)->where('id', '!=', $announcement->id)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }

            $announcement->update(['slug' => $slug]);
            $this->info("Fixed slug for: {$announcement->title} -> {$slug}");
        }

        $this->info('All announcement slugs have been fixed!');
    }
} 