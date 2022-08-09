<?php

namespace App\Imports;

use App\Models\Post;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');

class PostsImport implements
    ToModel,
    WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        $slug = trim(preg_replace("/[^\w\d]+/i", "-", $row['slug']), "-");
        $count = Post::where('slug', 'like', "%{$slug}%")->count();
        if($count > 0){
            $slug = $slug."-".($count+1);
            $newSlug = strtolower($slug);
        } else {
            $newSlug = strtolower($slug);
        }

        return new Post([
            'post_type' => $row['post_type'],
            'title' => $row['title'],
            'subtitle' => $row['subtitle'],
            'slug' => $newSlug,
            'description' => $row['description'],
            'keywords' => $row['keywords'],
            'tags' => $row['tags'],
            'author' => $row['author'],
            'content' => $row['content'],
            'video_embed_url' => $row['video_embed_url'],
            'status' => $row['status'],
            'opt_image_url' => $row['image_url'],
            'image_desc' => $row['image_description'],
            'category_id' => $row['category_id'],
            'location' => $row['location'],
            'admin_id' => request()->user()->id,
        ]);
    }
}
