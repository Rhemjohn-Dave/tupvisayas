<?php

namespace App\Models;

use App\Models\Concerns\LogsModelActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Procurement extends Model
{
    use HasFactory, LogsModelActivity;

    protected string $activityLogName = 'procurement';

    protected $fillable = [
        'title',
        'reference_no',
        'category',
        'posting_date',
        'closing_date',
        'file_url',
        'type',
        'status',
        'po_file_url',
        'po_files',
    ];

    protected array $activityLogAttributes = [
        'title', 'reference_no', 'category', 'posting_date', 'closing_date',
        'file_url', 'type', 'status', 'po_file_url', 'po_files',
    ];

    protected $casts = [
        'po_files' => 'array',
    ];
}
