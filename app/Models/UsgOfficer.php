<?php

namespace App\Models;

use App\Models\Concerns\LogsModelActivity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsgOfficer extends Model
{
    use HasFactory, LogsModelActivity;

    protected string $activityLogName = 'usg_officer';

    protected $fillable = [
        'name',
        'position',
        'photo',
        'term_label',
        'sort_order',
        'is_published',
    ];

    protected array $activityLogAttributes = [
        'name', 'position', 'photo', 'term_label', 'sort_order', 'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    public function photoUrl(): ?string
    {
        if (! $this->photo) {
            return null;
        }

        return asset('storage/'.$this->photo);
    }
}
