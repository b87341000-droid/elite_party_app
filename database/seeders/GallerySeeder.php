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
            ['title' => 'Midnight Drift Showdown', 'type' => 'image', 'category' => 'performance', 'file_path' => 'images/gallery/burnout.jpg', 'sort_order' => 1, 'is_published' => true],
            ['title' => 'Supercar Paddock at Dusk', 'type' => 'image', 'category' => 'performance', 'file_path' => 'images/gallery/supercar-paddock.jpg', 'sort_order' => 2, 'is_published' => true],
            ['title' => 'Mainstage Neon Blast', 'type' => 'image', 'category' => 'performance', 'file_path' => 'images/gallery/asake-stage.jpg', 'sort_order' => 3, 'is_published' => true],
            ['title' => 'VVIP Skyline Lounge', 'type' => 'image', 'category' => 'backstage', 'file_path' => 'images/gallery/burna-stage.jpg', 'sort_order' => 4, 'is_published' => true],
            ['title' => 'Afterparty Sunrise Energy', 'type' => 'image', 'category' => 'afterparty', 'file_path' => 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=800&h=600&fit=crop', 'sort_order' => 5, 'is_published' => true],
            ['title' => 'Concert Crowd Energy', 'type' => 'image', 'category' => 'crowd', 'file_path' => 'https://images.unsplash.com/photo-1501386761578-eac5c94b800a?w=800&h=600&fit=crop', 'sort_order' => 6, 'is_published' => true],
            ['title' => 'Luxury Car Showcase', 'type' => 'image', 'category' => 'performance', 'file_path' => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&h=600&fit=crop', 'sort_order' => 7, 'is_published' => true],
            ['title' => 'VIP Experience Zone', 'type' => 'image', 'category' => 'backstage', 'file_path' => 'https://images.unsplash.com/photo-1470229722913-7c0e2dbbafd3?w=800&h=600&fit=crop', 'sort_order' => 8, 'is_published' => true],
            ['title' => 'Twin Turbo GTR Rev Battle', 'type' => 'video', 'category' => 'performance', 'file_path' => null, 'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'sort_order' => 9, 'is_published' => true],
        ];

        foreach ($items as $item) {
            GalleryItem::create($item);
        }
    }
}
