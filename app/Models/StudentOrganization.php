<?php

namespace App\Models;

use App\Models\Concerns\SanitizesHtmlAttributes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentOrganization extends Model
{
    use HasFactory, SanitizesHtmlAttributes;

    protected array $htmlAttributes = ['description'];

    protected $fillable = [
        'college_page_id',
        'name',
        'logo',
        'description',
        'email',
        'website',
        'sort_order',
    ];

    public function collegePage()
    {
        return $this->belongsTo(CollegePage::class);
    }
}
