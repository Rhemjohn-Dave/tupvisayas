<?php

namespace App\Models;

use App\Models\Concerns\SanitizesHtmlAttributes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory, SanitizesHtmlAttributes;

    protected array $htmlAttributes = ['description'];

    protected $fillable = [
        'college_page_id',
        'name',
        'description',
        'logo',
    ];

    public function collegePage()
    {
        return $this->belongsTo(CollegePage::class);
    }

    public function department()
    {
        return $this->hasOne(Department::class);
    }
}
