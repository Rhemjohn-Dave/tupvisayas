<?php

namespace App\Models;

use App\Models\Concerns\LogsModelActivity;
use App\Models\Concerns\SanitizesHtmlAttributes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Announcement extends Model
{
    use HasFactory, SanitizesHtmlAttributes, LogsModelActivity;

    protected string $activityLogName = 'announcement';

    protected $fillable = ['title', 'slug', 'content', 'picture', 'category_id'];

    protected array $htmlAttributes = ['content'];

    protected array $activityLogAttributes = ['title', 'slug', 'content', 'picture', 'category_id'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($announcement) {
            if (empty($announcement->slug)) {
                // Generate slug from title with proper cleaning
                $cleanTitle = strip_tags($announcement->title);
                $cleanTitle = html_entity_decode($cleanTitle, ENT_QUOTES, 'UTF-8');
                $baseSlug = Str::slug($cleanTitle);

                if (empty($baseSlug)) {
                    $baseSlug = 'announcement-' . time();
                }

                $slug = $baseSlug;
                $counter = 1;

                // Make sure slug is unique
                while (static::where('slug', $slug)->exists()) {
                    $slug = $baseSlug . '-' . $counter;
                    $counter++;
                }

                $announcement->slug = $slug;
            }
        });

        static::updating(function ($announcement) {
            if ($announcement->isDirty('title') && empty($announcement->slug)) {
                // Generate slug from title with proper cleaning
                $cleanTitle = strip_tags($announcement->title);
                $cleanTitle = html_entity_decode($cleanTitle, ENT_QUOTES, 'UTF-8');
                $baseSlug = Str::slug($cleanTitle);

                if (empty($baseSlug)) {
                    $baseSlug = 'announcement-' . $announcement->id;
                }

                $slug = $baseSlug;
                $counter = 1;

                // Make sure slug is unique (excluding current announcement item)
                while (static::where('slug', $slug)->where('id', '!=', $announcement->id)->exists()) {
                    $slug = $baseSlug . '-' . $counter;
                    $counter++;
                }

                $announcement->slug = $slug;
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
