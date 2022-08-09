<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoTool extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_title',
        'home_title',
        'description',
        'keywords',
    ];
}
