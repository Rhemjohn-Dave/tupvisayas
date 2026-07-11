<?php

namespace App\Models;

use App\Models\Concerns\LogsModelActivity;
use App\Models\Concerns\SanitizesHtmlAttributes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Job extends Model
{
    use HasFactory, SanitizesHtmlAttributes, LogsModelActivity;

    protected string $activityLogName = 'job';

    protected $fillable = ['title', 'slug', 'content', 'picture', 'category_id'];

    protected array $htmlAttributes = ['content'];

    protected array $activityLogAttributes = ['title', 'slug', 'content', 'picture', 'category_id'];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($job) {
            if (empty($job->slug)) {
                $job->slug = static::generateUniqueSlug($job->title);
            }
        });

        static::updating(function ($job) {
            if ($job->isDirty('title')) {
                $job->slug = static::generateUniqueSlug($job->title, $job->id);
            }
        });
    }

    protected static function generateUniqueSlug(string $title, ?int $excludeId = null): string
    {
        $baseSlug = Str::slug(strip_tags($title)) ?: 'job';
        $slug = $baseSlug;
        $counter = 1;

        $query = static::where('slug', $slug);
        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        while ($query->exists()) {
            $slug = $baseSlug . '-' . $counter++;
            $query = static::where('slug', $slug);
            if ($excludeId) {
                $query->where('id', '!=', $excludeId);
            }
        }

        return $slug;
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
