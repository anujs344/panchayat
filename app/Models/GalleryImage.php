<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'description',
        'gallery_album_id',
        'gallery_category_id',
    ];

    public function album()
    {
        return $this->belongsTo(GalleryAlbum::class, 'gallery_album_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(GalleryCategory::class, 'gallery_category_id', 'id');
    }
}
