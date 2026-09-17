<?php

namespace Database\Seeders;

use App\Models\Artist;
use App\Models\Event;
use Illuminate\Database\Seeder;

class ArtistSeeder extends Seeder
{
    public function run(): void
    {
        Artist::truncate();

        $event = Event::where('slug', 'elite-block-party-2025')->firstOrFail();

        $artists = [
            [
                'name' => 'Ahmed Ololade',
                'stage_name' => 'ASAKE',
                'role' => 'Headliner',
                'bio' => 'Grammy-nominated Afrobeats sensation known for high-octane stage energy and amapiano fusions.',
                'photo' => null,
                'instagram' => 'asakemusic',
                'tiktok' => 'asakemusic',
                'twitter' => 'asakemusik',
                'is_headliner' => true,
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Damini Ogulu',
                'stage_name' => 'BURNA BOY',
                'role' => 'Headliner',
                'bio' => 'The African Giant himself bringing legendary energy to the Midnight Mainstage.',
                'photo' => null,
                'instagram' => 'burnaboygram',
                'tiktok' => 'burnaboy',
                'twitter' => 'burnaboy',
                'is_headliner' => true,
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Sodamola Oluseye Desmond',
                'stage_name' => 'DJ SPINALL',
                'role' => 'DJ & Producer',
                'bio' => 'Africa\'s top DJ headlining the VVIP drift afterparty till sunrise.',
                'photo' => null,
                'instagram' => 'djspinall',
                'tiktok' => 'djspinall',
                'twitter' => 'djspinall',
                'is_headliner' => false,
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Tochukwu Ojogwu',
                'stage_name' => 'ODUMODUBLVCK',
                'role' => 'Performer',
                'bio' => 'High energy drill and hip-hop heavyweight tearing down the pit lane stage.',
                'photo' => null,
                'instagram' => 'odumodublvck',
                'tiktok' => 'odumodublvck',
                'twitter' => 'odumodublvck_',
                'is_headliner' => false,
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Oyinkansola Sarah Aderibigbe',
                'stage_name' => 'AYRA STARR',
                'role' => 'Special Guest',
                'bio' => 'Global Afropop superstar performing her chart-topping hits.',
                'photo' => null,
                'instagram' => 'ayrastarr',
                'tiktok' => 'ayrastarr',
                'twitter' => 'ayrastarr',
                'is_headliner' => false,
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Florence Otedola',
                'stage_name' => 'DJ CUPPY',
                'role' => 'DJ & Host',
                'bio' => 'Electrifying neon stage sunset set and crowd host.',
                'photo' => null,
                'instagram' => 'cuppymusic',
                'tiktok' => 'cuppymusic',
                'twitter' => 'cuppymusic',
                'is_headliner' => false,
                'sort_order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($artists as $data) {
            $event->artists()->create($data);
        }
    }
}
