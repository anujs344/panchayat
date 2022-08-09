<?php

namespace App\Exports;

use App\Models\Post;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PostExampleExport implements
    FromArray,
    WithHeadings,
    WithStyles
{
    
    public function array(): array
    {
        return [
            [
                'article',
                'title',
                'subtitle',
                'post-title',
                'post',
                'post',
                'example, example1',
                'izhar',
                'content',
                'https://www.youtube.com/watch?v=gj8szNe-o4I',
                '1',
                'https://cdn.pixabay.com/photo/2021/08/01/12/58/beach-6514331_960_720.jpg',
                'description',
                '1',
                'patna',
            ],
        ];
    }

    public function headings(): array
    {
        return [
            'post_type',
            'title',
            'subtitle',
            'slug',
            'description',
            'keywords',
            'tags',
            'author',
            'content',
            'video_embed_url',
            'status',
            'image_url',
            'image_description',
            'category_id',
            'location',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }
}
