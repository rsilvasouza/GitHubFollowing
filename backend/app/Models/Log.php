<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'endpoint',
        'method',
        'status_code',
        'response_body',
        'response_headers',
        'ip_address',
        'user_agent',
        'duration_ms',
    ];
}
