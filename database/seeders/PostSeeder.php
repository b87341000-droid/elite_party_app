<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\PostCategory;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        Post::truncate();

        $admin = User::first();
        $news = PostCategory::where('slug', 'festival-news')->first();
        $cars = PostCategory::where('slug', 'car-culture')->first();
        $guide = PostCategory::where('slug', 'attendee-guide')->first();

        $posts = [
            [
                'user_id' => $admin?->id,
                'post_category_id' => $news?->id,
                'title' => 'Phase 1 Headliners Revealed: Asake, Burna Boy, and Special International Guests',
                'slug' => 'phase-1-headliners-revealed',
                'excerpt' => 'The biggest street culture gathering in West Africa drops its first wave of world-class performers.',
                'body' => 'Lagos is ready to erupt. Elite Block Party 2025 announces the first batch of legendary artists taking the Midnight Mainstage this December. From ground-shaking amapiano beats to global afro-fusion chart-toppers, get ready for a 12-hour high-octane celebration.',
                'cover_image' => 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=800&h=450&fit=crop',
                'status' => 'published',
                'published_at' => now()->subDays(5),
                'views' => 1420,
            ],
            [
                'user_id' => $admin?->id,
                'post_category_id' => $cars?->id,
                'title' => '200+ Supercars, JDM Legends and Drift Beasts Ready for Lagos Showcase',
                'slug' => 'supercars-and-jdm-legends',
                'excerpt' => 'An unprecedented collection of high-horsepower builds from across the continent arrives at Eko Hotel.',
                'body' => 'Get up close with twin-turbo Nissan GTRs, widebody Porsche 911 GT3 RSs, Lamborghini Huracans, and bespoke classic muscle restomods. Owners and master tuners will be on site for live rev battles and dyno showcases.',
                'cover_image' => 'https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?w=800&h=450&fit=crop',
                'status' => 'published',
                'published_at' => now()->subDays(2),
                'views' => 890,
            ],
            [
                'user_id' => $admin?->id,
                'post_category_id' => $guide?->id,
                'title' => 'Everything You Need to Know: Parking, Security & Fast-Track Access',
                'slug' => 'everything-you-need-to-know',
                'excerpt' => 'Essential guidelines to ensure your Elite Block Party night runs smoothly from door to dawn.',
                'body' => 'Gates open sharply at 4:00 PM. Have your digital QR code ready on your phone or Apple/Google Wallet. Dedicated valet and secure parking zones will be strictly monitored by elite security personnel.',
                'cover_image' => 'https://images.unsplash.com/photo-1540039155733-5bb30b53aa14?w=800&h=450&fit=crop',
                'status' => 'published',
                'published_at' => now()->subDay(),
                'views' => 2100,
            ],
        ];

        foreach ($posts as $post) {
            Post::create($post);
        }
    }
}
