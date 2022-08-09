<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMediaSetting extends Model
{
    use HasFactory;
    protected $fillable = [
        'facebook_url',
        'twitter_url',
        'instagram_url',
        'pinterest_url',
        'linkedIn_url',
        'vk_url',
        'telegram_url',
        'youtube_url',
    ];
}
