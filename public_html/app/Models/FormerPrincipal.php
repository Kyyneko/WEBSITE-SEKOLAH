<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormerPrincipal extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'period',
        'photo_path',
    ];
}
