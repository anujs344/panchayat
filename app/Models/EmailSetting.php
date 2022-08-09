<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'library',
        'from_address',
        'from_name',
        'host',
        'port',
        'username',
        'password',
        'verification_status',
        'contact_message_status',
        'contact_message_email',
    ];

    public static $mailers = [
        ['id' => '1', 'name' => 'smtp'],
        // ['id' => '2', 'name' => 'mailgun'],
        // ['id' => '3', 'name' => 'sendmail'],
    ];
}
