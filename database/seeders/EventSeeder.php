<?php

namespace Database\Seeders;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        Event::truncate();

        Event::create([
            'name' => 'Elite Block Party 2025',
            'slug' => 'elite-block-party-2025',
            'tagline' => 'Car showcase. Music festival. Nightlife. One night. One city.',
            'description' => 'The ultimate car showcase, music festival, and nightlife experience. 200+ custom cars, Nigeria\'s hottest artists, premium hospitality — all under one roof for one iconic night in Lagos.',
            'venue_name' => 'Eko Hotel & Suites',
            'venue_address' => 'Plot 1415 Adetokunbo Ademola Street',
            'city' => 'Lagos',
            'state' => 'Lagos',
            'country' => 'Nigeria',
            'starts_at' => Carbon::parse('2025-12-20 18:00:00'),
            'ends_at' => Carbon::parse('2025-12-21 04:00:00'),
            'doors_open_at' => Carbon::parse('2025-12-20 16:00:00'),
            'hero_image' => '/images/hero-car.jpg',
            'flyer_image' => '/images/flyer.jpg',
            'logo_image' => '/images/logo.png',
            'social_links' => [
                'instagram' => 'https://instagram.com/elite-tickets',
                'twitter' => 'https://twitter.com/eliteblockparty',
            ],
            'is_active' => true,
            'tickets_on_sale' => true,
        ]);
    }
}
