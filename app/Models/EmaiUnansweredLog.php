<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmaiUnansweredLog extends Model
{
    protected $fillable = [
        'message',
        'ip_address',
        'user_agent',
    ];
}
