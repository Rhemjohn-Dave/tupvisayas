<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollegePage extends Model
{
    use HasFactory;

    protected $fillable = [
        'college',
        'cover_photo',
        'history',
        'department_faculty',
        'student_organization',
    ];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function departments()
    {
        return $this->hasMany(Department::class);
    }
}
