<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentOrganization extends Model
{
    use HasFactory;

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
