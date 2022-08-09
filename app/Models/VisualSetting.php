<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisualSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'logo',
        'logo_footer',
        'logo_email',
        'favicon_icon',
    ];
}
