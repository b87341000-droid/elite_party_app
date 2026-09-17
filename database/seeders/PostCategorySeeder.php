<?php

namespace Database\Seeders;

use App\Models\PostCategory;
use Illuminate\Database\Seeder;

class PostCategorySeeder extends Seeder
{
    public function run(): void
    {
        PostCategory::truncate();

        $categories = [
            ['name' => 'Festival News', 'slug' => 'festival-news', 'description' => 'Updates, lineup drops, and schedule news.'],
            ['name' => 'Car Culture', 'slug' => 'car-culture', 'description' => 'Supercars, tuning guides, drift culture, and builder spotlights.'],
            ['name' => 'VIP & Hospitality', 'slug' => 'vip-hospitality', 'description' => 'Exclusive table packages, perks, and luxury experience guides.'],
            ['name' => 'Attendee Guide', 'slug' => 'attendee-guide', 'description' => 'Security, ticketing, parking, and survival guides.'],
        ];

        foreach ($categories as $cat) {
            PostCategory::create($cat);
        }
    }
}
