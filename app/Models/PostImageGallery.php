<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostImageGallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
    ];

    function postMainImage()
    {
        return $this->hasOne(Post::class, 'post_image_gallery_id', 'id');
    }

}
