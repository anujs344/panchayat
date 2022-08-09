<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsletterSubscriber extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'email_verified_at',
        'status',
    ];
    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

}
