<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        Review::truncate();

        $reviews = [
            [
                'author_name' => 'Tunde Adebayo',
                'author_email' => 'tunde@example.com',
                'author_photo' => null,
                'rating' => 5,
                'comment' => 'The raw energy at the drift arena was insane! The sound system rattled my soul and the supercar lineup was top tier. Definitely doing VVIP next time.',
                'is_approved' => true,
                'is_featured' => true,
            ],
            [
                'author_name' => 'Zainab Bello',
                'author_email' => 'zainab@example.com',
                'author_photo' => null,
                'rating' => 5,
                'comment' => 'Best party in Lagos hands down. VIP hospitality was seamless, seamless entry with the QR tickets, and the drinks never stopped flowing.',
                'is_approved' => true,
                'is_featured' => true,
            ],
            [
                'author_name' => 'Chuka Okafor',
                'author_email' => 'chuka@example.com',
                'author_photo' => null,
                'rating' => 5,
                'comment' => 'Car culture meets Afrobeat perfection. The rev battles alone were worth every kobo. Don\'t sleep on this festival.',
                'is_approved' => true,
                'is_featured' => true,
            ],
        ];

        foreach ($reviews as $review) {
            Review::create($review);
        }
    }
}
