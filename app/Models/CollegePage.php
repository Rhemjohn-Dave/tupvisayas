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
    ];

    protected array $activityLogAttributes = [
        'college', 'cover_photo', 'history', 'department_faculty', 'student_organization',
    ];

    protected $fillable = [
        'college',
        'cover_photo',
        'history',
        'department_faculty',
        'student_organization',
    ];

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget('navbar.college_pages'));
        static::deleted(fn () => Cache::forget('navbar.college_pages'));
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
}
