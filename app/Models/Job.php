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

    public const TYPE_JOB_OPENING = 'job_opening';

    public const TYPE_CAMPUS_RECRUITMENT = 'campus_recruitment';

    protected string $activityLogName = 'job';

    protected $fillable = ['title', 'slug', 'content', 'picture', 'category_id', 'listing_type'];

    protected array $htmlAttributes = ['content'];

    protected array $activityLogAttributes = ['title', 'slug', 'content', 'picture', 'category_id', 'listing_type'];

    public static function listingTypes(): array
    {
        return [
            self::TYPE_JOB_OPENING => 'Job opening',
            self::TYPE_CAMPUS_RECRUITMENT => 'Campus recruitment',
        ];
    }

    public function isCampusRecruitment(): bool
    {
        return $this->listing_type === self::TYPE_CAMPUS_RECRUITMENT;
    }

    public function listingTypeLabel(): string
    {
        return self::listingTypes()[$this->listing_type] ?? 'Job opening';
    }

    public function officeLabel(): string
    {
        return $this->isCampusRecruitment()
            ? 'Supervised Industrial Training (SIT)'
            : 'Human Resources';
    }

    public static function indexUrl(?string $type = null): string
    {
        if (($type ?: self::TYPE_JOB_OPENING) === self::TYPE_CAMPUS_RECRUITMENT) {
            return route('sit') . '#sit-recruitment';
        }

        return route('human-resources');
    }

    public function audienceLabel(): string
    {
        return $this->isCampusRecruitment()
            ? 'For TUP Visayas students (SIT / OJT)'
            : 'For faculty and staff applicants';
    }

    public function scopeListingType($query, string $type)
    {
        return $query->where('listing_type', $type);
    }

    public function scopeJobOpenings($query)
    {
        return $query->where('listing_type', self::TYPE_JOB_OPENING);
    }

    public function scopeCampusRecruitment($query)
    {
        return $query->where('listing_type', self::TYPE_CAMPUS_RECRUITMENT);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($job) {
            if (empty($job->listing_type)) {
                $job->listing_type = static::TYPE_JOB_OPENING;
            }
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
