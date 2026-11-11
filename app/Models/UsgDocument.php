<?php

namespace App\Models;

use App\Models\Concerns\LogsModelActivity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsgDocument extends Model
{
    use HasFactory, LogsModelActivity;

    public const CATEGORY_MEMORANDUM = 'memorandum';

    public const CATEGORY_RESOLUTION = 'resolution';

    public const CATEGORY_EXECUTIVE_ORDER = 'executive_order';

    public const CATEGORY_ADVISORY = 'advisory';

    public const CATEGORY_OTHER = 'other';

    protected string $activityLogName = 'usg_document';

    protected $fillable = [
        'title',
        'reference_no',
        'category',
        'issued_at',
        'summary',
        'file_path',
        'is_published',
    ];

    protected array $activityLogAttributes = [
        'title', 'reference_no', 'category', 'issued_at', 'summary', 'file_path', 'is_published',
    ];

    protected $casts = [
        'issued_at' => 'date',
        'is_published' => 'boolean',
    ];

    /**
     * @return array<string, string>
     */
    public static function categoryOptions(): array
    {
        return [
            self::CATEGORY_MEMORANDUM => 'Memorandum',
            self::CATEGORY_RESOLUTION => 'Resolution',
            self::CATEGORY_EXECUTIVE_ORDER => 'Executive Order',
            self::CATEGORY_ADVISORY => 'Advisory',
            self::CATEGORY_OTHER => 'Other',
        ];
    }

    public function getCategoryLabelAttribute(): string
    {
        return self::categoryOptions()[$this->category] ?? ucfirst(str_replace('_', ' ', (string) $this->category));
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    public function fileUrl(): ?string
    {
        if (! $this->file_path) {
            return null;
        }

        return asset('storage/'.$this->file_path);
    }
}
