<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'post_file_gallery_id',
    ];

    function postFile()
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }

    public function postFileGallery()
    {
        return $this->belongsTo(PostFileGallery::class, 'post_file_gallery_id', 'id');
    }

}
