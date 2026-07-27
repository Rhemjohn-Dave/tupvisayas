<?php

namespace App\Models;

use App\Models\Concerns\LogsModelActivity;
use App\Models\Concerns\SanitizesHtmlAttributes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class CollegePage extends Model
{
    use HasFactory, SanitizesHtmlAttributes, LogsModelActivity;

    protected string $activityLogName = 'college_page';

    protected array $htmlAttributes = [
        'history',
        'department_faculty',
        'student_organization',
        'board_exam_ratings',
    ];

    protected array $activityLogAttributes = [
        'college', 'cover_photo', 'history', 'board_exam_ratings', 'department_faculty', 'student_organization',
    ];

    protected $fillable = [
        'college',
        'cover_photo',
        'history',
        'board_exam_ratings',
        'department_faculty',
        'student_organization',
    ];

    public const ROUTE_SLUGS = [
        'College of Engineering' => 'coe',
        'College of Automation and Control' => 'coac',
        'College of Automation and Control Engineering' => 'coac',
        'College of Engineering Technology' => 'coet',
    ];

    public const SLUG_NAMES = [
        'coe' => 'College of Engineering',
        'coac' => 'College of Automation and Control',
        'coet' => 'College of Engineering Technology',
    ];

    /** Alternate DB titles accepted for each short key */
    private const SLUG_NAME_VARIANTS = [
        'coe' => [
            'College of Engineering',
        ],
        'coac' => [
            'College of Automation and Control',
            'College of Automation and Control Engineering',
        ],
        'coet' => [
            'College of Engineering Technology',
        ],
    ];

    /** Common legacy / mistyped URL segments → preferred college name */
    private const SLUG_ALIASES = [
        'college-of-automation-and-control' => 'College of Automation and Control',
        'college-of-automation-and-control-engineering' => 'College of Automation and Control Engineering',
        'college-of-engineering' => 'College of Engineering',
        'college-of-engineering-technology' => 'College of Engineering Technology',
    ];

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget('navbar.college_pages'));
        static::deleted(fn () => Cache::forget('navbar.college_pages'));

        static::saved(fn () => \App\Services\EmaiFaqService::clearCache());
        static::deleted(fn () => \App\Services\EmaiFaqService::clearCache());
    }

    public function routeSlug(): string
    {
        if (isset(self::ROUTE_SLUGS[$this->college])) {
            return self::ROUTE_SLUGS[$this->college];
        }

        // Fuzzy: map known short keys when the stored title is a close variant
        foreach (self::SLUG_NAME_VARIANTS as $short => $names) {
            foreach ($names as $name) {
                if (str_starts_with($this->college, $name) || str_starts_with($name, $this->college)) {
                    return $short;
                }
            }
        }

        return \Illuminate\Support\Str::slug($this->college);
    }

    public static function nameFromRouteSlug(string $slug): string
    {
        $slug = trim(rawurldecode($slug));

        return self::SLUG_NAMES[$slug]
            ?? self::SLUG_ALIASES[\Illuminate\Support\Str::slug($slug)]
            ?? $slug;
    }

    /**
     * Resolve a public /academics/{college} segment to a college page.
     * Accepts short keys (coac), exact names, slugified names, and known aliases.
     */
    public static function findByRouteParam(string $param): ?self
    {
        $param = trim(rawurldecode($param));
        if ($param === '') {
            return null;
        }

        if (isset(self::SLUG_NAME_VARIANTS[$param])) {
            $byVariant = static::whereIn('college', self::SLUG_NAME_VARIANTS[$param])->first();
            if ($byVariant) {
                return $byVariant;
            }

            // Production DB may use a slightly longer/shorter title
            foreach (self::SLUG_NAME_VARIANTS[$param] as $name) {
                $fuzzy = static::where('college', 'like', $name . '%')->first();
                if ($fuzzy) {
                    return $fuzzy;
                }
            }
        }

        $byExactName = static::where('college', $param)->first();
        if ($byExactName) {
            return $byExactName;
        }

        $wanted = \Illuminate\Support\Str::slug($param);

        if (isset(self::SLUG_ALIASES[$wanted])) {
            $preferred = self::SLUG_ALIASES[$wanted];
            $aliased = static::where('college', $preferred)->first()
                ?? static::where('college', 'like', $preferred . '%')->first();
            if ($aliased) {
                return $aliased;
            }
        }

        $colleges = static::query()->get();

        $bySlug = $colleges->first(
            fn (self $college) => \Illuminate\Support\Str::slug($college->college) === $wanted
        );
        if ($bySlug) {
            return $bySlug;
        }

        $prefixMatches = $colleges->filter(function (self $college) use ($wanted) {
            $slug = \Illuminate\Support\Str::slug($college->college);

            return str_starts_with($wanted, $slug) || str_starts_with($slug, $wanted);
        });

        return $prefixMatches->count() === 1 ? $prefixMatches->first() : null;
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function departments()
    {
        return $this->hasMany(Department::class);
    }

    public function studentOrganizations()
    {
        return $this->hasMany(StudentOrganization::class)
            ->orderBy('sort_order')
            ->orderBy('name');
    }

    public function officials()
    {
        return $this->hasMany(Official::class)->orderBy('order');
    }

    /**
     * College dean for public display (linked official, preferring "Dean" in the title).
     */
    public function dean(): ?Official
    {
        $linked = $this->officials;

        if ($linked->isEmpty()) {
            return null;
        }

        return $linked->first(function (Official $official) {
            return stripos($official->position, 'dean') !== false;
        }) ?? $linked->first();
    }
}
