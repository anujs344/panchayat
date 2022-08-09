<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_limit',
        'cookie_warning',
        'cookie_text',
        'footer_about_section',
        'post_url',
        'copyright',
    ];
}
