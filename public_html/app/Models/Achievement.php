<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'medal', // gold, silver, bronze
        'student',
        'date',
        'location',
        'description',
        'photo_path',
    ];
}
