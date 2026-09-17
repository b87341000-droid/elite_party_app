<?php

namespace Database\Seeders;

use App\Models\Sponsor;
use Illuminate\Database\Seeder;

class SponsorSeeder extends Seeder
{
    public function run(): void
    {
        Sponsor::truncate();

        $sponsors = [
            [
                'name' => 'Monster Energy',
                'logo' => '/images/sponsors/monster.svg',
                'website' => 'https://monsterenergy.com',
                'tier' => 'platinum',
                'description' => 'Official energy drink partner powering the midnight stage.',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Pirelli Tires',
                'logo' => '/images/sponsors/pirelli.svg',
                'website' => 'https://pirelli.com',
                'tier' => 'platinum',
                'description' => 'Official motorsport tire and drift sponsor.',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Hennessy',
                'logo' => '/images/sponsors/hennessy.svg',
                'website' => 'https://hennessy.com',
                'tier' => 'gold',
                'description' => 'Exclusive VIP lounge & bottle service sponsor.',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Red Bull Racing',
                'logo' => '/images/sponsors/redbull.svg',
                'website' => 'https://redbull.com',
                'tier' => 'gold',
                'description' => 'High octane stunt exhibition and speed zone partner.',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Brembo Brakes',
                'logo' => '/images/sponsors/brembo.svg',
                'website' => 'https://brembo.com',
                'tier' => 'silver',
                'description' => 'High performance braking systems display partner.',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Soundcity TV',
                'logo' => '/images/sponsors/soundcity.svg',
                'website' => 'https://soundcity.tv',
                'tier' => 'partner',
                'description' => 'Official broadcast media partner.',
                'sort_order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($sponsors as $sponsor) {
            Sponsor::create($sponsor);
        }
    }
}
