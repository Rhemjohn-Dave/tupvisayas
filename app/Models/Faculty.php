<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'name',
        'rank',
        'photo',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
