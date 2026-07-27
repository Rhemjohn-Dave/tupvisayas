<?php

namespace App\Models;

use App\Models\Concerns\LogsModelActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdmissionTestSchedule extends Model
{
    use HasFactory, LogsModelActivity;

    protected string $activityLogName = 'admission_schedule';

    protected $fillable = [
        'exam_date',
        'times',
        'venue',
        'venue_note',
        'address',
        'is_published',
        'sort_order',
    ];

    protected array $activityLogAttributes = [
        'exam_date',
        'times',
        'venue',
        'venue_note',
        'address',
        'is_published',
        'sort_order',
    ];

    protected $casts = [
        'exam_date' => 'date',
        'is_published' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('exam_date')->orderBy('sort_order')->orderBy('id');
    }

    /**
     * Time slots as lines for display (supports newline or " / " separators).
     *
     * @return list<string>
     */
    public function timeLines(): array
    {
        $raw = str_replace(["\r\n", "\r"], "\n", (string) $this->times);
        $raw = str_replace(' / ', "\n", $raw);

        return array_values(array_filter(array_map('trim', explode("\n", $raw))));
    }

    public function displayDate(): string
    {
        return $this->exam_date?->format('F j, Y') ?? '';
    }

    protected static function booted(): void
    {
        static::saved(fn () => \App\Services\EmaiFaqService::clearCache());
        static::deleted(fn () => \App\Services\EmaiFaqService::clearCache());
    }
}
