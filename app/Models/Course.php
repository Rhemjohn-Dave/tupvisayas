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
        'career_opportunities',
        'program_objectives',
        'program_outcomes',
        'curriculum',
        'facilities_labs',
        'accreditation_info',
        'board_performance',
        'scholarships',
        'faq',
    ];

    protected $fillable = [
        'college_page_id',
        'name',
        'slug',
        'description',
        'career_opportunities',
        'program_objectives',
        'program_outcomes',
        'curriculum',
        'facilities_labs',
        'accreditation_info',
        'board_performance',
        'scholarships',
        'faq',
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

    /**
     * Labels for optional public program-page sections (admin checklist order).
     *
     * @return array<string, string>
     */
    public static function micrositeSectionLabels(): array
    {
        return [
            'description' => 'Overview',
            'career_opportunities' => 'Career opportunities',
            'program_objectives' => 'Program educational objectives (PEOs)',
            'program_outcomes' => 'Program outcomes',
            'curriculum' => 'Curriculum',
            'facilities_labs' => 'Labs & facilities',
            'accreditation_info' => 'Accreditation',
            'board_performance' => 'Board performance',
            'scholarships' => 'Scholarships',
            'faq' => 'Frequently asked questions',
        ];
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
