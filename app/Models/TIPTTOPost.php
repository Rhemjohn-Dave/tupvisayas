<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TIPTTOPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
<<<<<<< HEAD
        'slug',
=======
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
        'content',
        'excerpt',
        'featured_image',
        'is_published',
        'published_at',
<<<<<<< HEAD
        'author_id',
=======
        'author_id'
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
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
