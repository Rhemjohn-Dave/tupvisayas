<?php

namespace App\Models;

use App\Models\Concerns\LogsModelActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Official extends Model
{
    use HasFactory, LogsModelActivity;

    protected string $activityLogName = 'official';

    protected $fillable = [
        'name',
        'position',
        'photo',
        'order',
    ];

    protected array $activityLogAttributes = ['name', 'position', 'photo', 'order'];
}
