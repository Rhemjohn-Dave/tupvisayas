<?php

namespace App\Models;

use App\Models\Concerns\SanitizesHtmlAttributes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Course extends Model
{
    use HasFactory, SanitizesHtmlAttributes;

    protected array $htmlAttributes = [
        'description',
        'curriculum',
        'facilities_labs',
        'accreditation_info',
        'board_performance',
        'scholarships',
    ];

    protected $fillable = [
        'college_page_id',
        'name',
        'slug',
        'description',
        'curriculum',
        'facilities_labs',
        'accreditation_info',
        'board_performance',
        'scholarships',
        'logo',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Course $course) {
            if (empty($course->slug)) {
                $course->slug = static::generateUniqueSlug($course->name);
            }
        });

        static::updating(function (Course $course) {
            if (! $course->isDirty('slug')) {
                return;
            }

            $course->slug = filled($course->slug)
                ? static::generateUniqueSlug($course->slug, $course->id)
                : static::generateUniqueSlug($course->name, $course->id);
        });
    }

    public static function generateUniqueSlug(string $value, ?int $excludeId = null): string
    {
        $baseSlug = Str::slug(strip_tags($value)) ?: 'program';
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

    public function hasSection(string $attribute): bool
    {
        return filled(trim(strip_tags((string) $this->{$attribute})));
    }

    public function collegePage()
    {
        return $this->belongsTo(CollegePage::class);
    }

    public function department()
    {
        return $this->hasOne(Department::class);
    }
}
