<?php

namespace App\Models;

use App\Models\Concerns\LogsModelActivity;
use App\Models\Concerns\SanitizesHtmlAttributes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrPost extends Model
{
    use HasFactory, SanitizesHtmlAttributes, LogsModelActivity;

    public const TYPE_ANNOUNCEMENT = 'announcement';

    public const TYPE_SEMINAR = 'seminar';

    public const TYPE_CONFERENCE = 'conference';

    public const TYPE_TRAINING = 'training';

    public const TYPE_OATH_TAKING = 'oath_taking';

    /** @var list<string> */
    public const PROGRAM_TYPES = [
        self::TYPE_SEMINAR,
        self::TYPE_CONFERENCE,
        self::TYPE_TRAINING,
        self::TYPE_OATH_TAKING,
    ];

    protected string $activityLogName = 'hr_post';

    protected array $htmlAttributes = ['content'];

    protected array $activityLogAttributes = [
        'title', 'slug', 'type', 'content', 'excerpt', 'featured_image', 'report_file',
        'department_id', 'event_date', 'is_published', 'published_at', 'author_id',
    ];

    protected $fillable = [
        'title',
        'slug',
        'type',
        'content',
        'excerpt',
        'featured_image',
        'report_file',
        'department_id',
        'event_date',
        'is_published',
        'published_at',
        'author_id',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'event_date' => 'date',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function isProgram(): bool
    {
        return in_array($this->type, self::PROGRAM_TYPES, true);
    }

    public function getTypeLabelAttribute(): string
    {
        return match ($this->type) {
            self::TYPE_CONFERENCE => 'Conference',
            self::TYPE_TRAINING => 'Training',
            self::TYPE_OATH_TAKING => 'Oath Taking',
            self::TYPE_SEMINAR => 'Seminar',
            default => 'Announcement',
        };
    }

    public static function typeOptions(): array
    {
        return [
            self::TYPE_ANNOUNCEMENT => 'Announcement',
            self::TYPE_SEMINAR => 'Seminar',
            self::TYPE_CONFERENCE => 'Conference',
            self::TYPE_TRAINING => 'Training',
            self::TYPE_OATH_TAKING => 'Oath Taking',
        ];
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    public function scopeAnnouncements(Builder $query): Builder
    {
        return $query->where('type', self::TYPE_ANNOUNCEMENT);
    }

    public function scopePrograms(Builder $query): Builder
    {
        return $query->whereIn('type', self::PROGRAM_TYPES);
    }

    /** @deprecated Use scopePrograms() — kept for call-site compatibility */
    public function scopeSeminars(Builder $query): Builder
    {
        return $query->programs();
    }
}
