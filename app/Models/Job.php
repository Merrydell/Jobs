<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'role',
        'company',
        'contact',
        'apply',
        'location',
        'is_admin',
        'status'
    ];

    protected $casts = [
        'is_admin' => 'boolean'
    ];
}
