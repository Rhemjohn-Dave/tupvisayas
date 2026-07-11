<?php

namespace App\Models;

use App\Models\Concerns\LogsModelActivity;
use App\Models\Concerns\SanitizesHtmlAttributes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TIPTTOPost extends Model
{
    use HasFactory, SanitizesHtmlAttributes, LogsModelActivity;

    protected string $activityLogName = 'tiptto_post';

    protected array $htmlAttributes = ['content'];

    protected array $activityLogAttributes = [
        'title', 'slug', 'content', 'excerpt', 'featured_image', 'is_published', 'published_at', 'author_id',
    ];
    protected $fillable = [
        'title',
        'slug',
        'content',
        'excerpt',
        'featured_image',
        'is_published',
        'published_at',
        'author_id',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function getRouteKeyName()
    {
        return 'id';
    }
}
