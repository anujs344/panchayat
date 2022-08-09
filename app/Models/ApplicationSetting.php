<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_name',
        'timezone',
        'cookie_prefix',
    ];

    public static $timezones = [
        ['id' => '1', 'name' => 'Asia/Kolkata'],
        ['id' => '2', 'name' => 'Asia/Qatar'],
        ['id' => '3', 'name' => 'Asia/Riyadh'],
        ['id' => '4', 'name' => 'America/Boise'],
    ];
}
