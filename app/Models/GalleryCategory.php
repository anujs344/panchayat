<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'gallery_album_id',
    ];

    public function images()
    {
        return $this->hasMany(GalleryImage::class, 'gallery_category_id', 'id');
    }

    public function album()
    {
        return $this->belongsTo(GalleryAlbum::class, 'gallery_album_id', 'id');
    }
}
