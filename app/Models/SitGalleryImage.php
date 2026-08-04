<?php

namespace App\Models;

use App\Models\Concerns\LogsModelActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SitGalleryImage extends Model
{
    use HasFactory, LogsModelActivity;

    protected string $activityLogName = 'sit';

    protected $fillable = [
        'image_path',
        'caption',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    protected array $activityLogAttributes = [
        'image_path',
        'caption',
        'order',
        'is_active',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderByDesc('id');
    }
}
