<?php

namespace Database\Seeders;

use App\Models\GalleryItem;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        GalleryItem::truncate();

        $items = [
            ['title' => 'Midnight Drift Showdown', 'type' => 'image', 'category' => 'performance', 'file_path' => null, 'sort_order' => 1, 'is_published' => true],
            ['title' => 'Supercar Paddock at Dusk', 'type' => 'image', 'category' => 'crowd', 'file_path' => null, 'sort_order' => 2, 'is_published' => true],
            ['title' => 'Mainstage Neon Blast', 'type' => 'image', 'category' => 'performance', 'file_path' => null, 'sort_order' => 3, 'is_published' => true],
            ['title' => 'VVIP Skyline Lounge', 'type' => 'image', 'category' => 'backstage', 'file_path' => null, 'sort_order' => 4, 'is_published' => true],
            ['title' => 'Afterparty Sunrise Energy', 'type' => 'image', 'category' => 'afterparty', 'file_path' => null, 'sort_order' => 5, 'is_published' => true],
            ['title' => 'Twin Turbo GTR Rev Battle', 'type' => 'video', 'category' => 'performance', 'file_path' => null, 'video_url' => 'https://youtube.com', 'sort_order' => 6, 'is_published' => true],
        ];

        foreach ($items as $item) {
            GalleryItem::create($item);
        }
    }
}
