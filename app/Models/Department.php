<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'college_page_id',
        'name',
    ];

    public function collegePage()
    {
        return $this->belongsTo(CollegePage::class);
    }

    public function faculties()
    {
        return $this->hasMany(Faculty::class);
    }
}
