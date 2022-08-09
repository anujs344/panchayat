<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'keywords',
        'color',
    ];

    public function navigation()
    {
        return $this->hasOne(Navigation::class, 'category_id', 'id');
    }

    public function subcategory()
    {
        return $this->hasOne(Subcategory::class, 'category_id', 'id');
    }

    public function child()
    {
        return $this->hasMany(Subcategory::class, 'category_id', 'id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'category_id', 'id')->latest();
    }

}
