<?php

namespace App\Exports;

use App\Models\Post;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PostTemplateExport implements
    WithHeadings,
    WithStyles
{
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
