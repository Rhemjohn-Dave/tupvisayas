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
<<<<<<< HEAD

    public function studentOrganizations()
    {
        return $this->hasMany(StudentOrganization::class)
            ->orderBy('sort_order')
            ->orderBy('name');
    }
=======
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
}
