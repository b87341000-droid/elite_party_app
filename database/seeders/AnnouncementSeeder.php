<?php

namespace Database\Seeders;

use App\Models\Announcement;
use App\Models\User;
use Illuminate\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    public function run(): void
    {
        Announcement::truncate();

        $admin = User::first();

        Announcement::create([
            'title' => 'Early Bird Tier Almost Sold Out!',
            'body' => 'Regular and VIP tickets are selling rapidly. Grab your pass before midnight to lock in early bird rates.',
            'audience' => 'all',
            'send_email' => false,
            'is_published' => true,
            'published_at' => now(),
            'created_by' => $admin?->id,
        ]);

        Announcement::create([
            'title' => 'Supercar & Drift Registration Now Open',
            'body' => 'Car owners wishing to enter their vehicles into the showcase or drift exhibition pit must submit applications before Dec 1st.',
            'audience' => 'all',
            'send_email' => false,
            'is_published' => true,
            'published_at' => now()->subHours(12),
            'created_by' => $admin?->id,
        ]);
    }
}
