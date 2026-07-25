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
        'quote',
        'photo',
        'order',
        'college_page_id',
    ];

    protected array $activityLogAttributes = ['name', 'position', 'quote', 'photo', 'order', 'college_page_id'];

    public function collegePage()
    {
        return $this->belongsTo(CollegePage::class);
    }
}
