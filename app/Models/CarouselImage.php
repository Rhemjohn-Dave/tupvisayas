<?php

namespace App\Models;

use App\Models\Concerns\LogsModelActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarouselImage extends Model
{
    use HasFactory, LogsModelActivity;

    protected string $activityLogName = 'carousel';

    protected $fillable = [
        'image_path',
        'caption',
        'order',
    ];

    protected array $activityLogAttributes = ['image_path', 'caption', 'order'];
}
