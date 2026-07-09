<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Official extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
        'photo',
<<<<<<< HEAD
        'order',
=======
        'bio',
        'order',
        'social_links'
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
    ];
}
