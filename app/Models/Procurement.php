<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Procurement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'reference_no',
        'category',
        'posting_date',
        'closing_date',
        'file_url',
        'type',
    ];
}
