<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialLoginConfiguration extends Model
{
    use HasFactory;

    protected $fillable = [
        'facebook_id',
        'facebook_secret',
        'google_id',
        'google_secret',
    ];
}
