<?php

namespace Database\Seeders;

use App\Models\Sponsor;
use Illuminate\Database\Seeder;

class SponsorSeeder extends Seeder
{
    public function run(): void
    {
        $sponsors = [
            // [name, tier, website, logo]
            ['Hennessy',         'platinum', 'https://hennessy.com',  '/images/sponsors/hennessy.svg'],
            ['Martell',          'platinum', 'https://martell.com',   'https://images.unsplash.com/photo-1551024601-bec78aea704b?w=300&h=150&fit=crop'],
            ['Guinness Nigeria', 'platinum', 'https://guinness.com',  'https://images.unsplash.com/photo-1608270586620-248524c67de9?w=300&h=150&fit=crop'],
            ['Red Bull',         'gold',     'https://redbull.com',   '/images/sponsors/redbull.svg'],
            ['Monster Energy',   'gold',     'https://monsterenergy.com', '/images/sponsors/monster.svg'],
            ['Brembo',           'gold',     'https://brembo.com',    '/images/sponsors/brembo.svg'],
            ['Pirelli',          'silver',   'https://pirelli.com',   '/images/sponsors/pirelli.svg'],
            ['MTN Nigeria',      'silver',   'https://mtn.ng',        'https://images.unsplash.com/photo-1611224923853-80b023f02d71?w=300&h=150&fit=crop'],
            ['Airtel',           'silver',   'https://airtel.ng',     'https://images.unsplash.com/photo-1560472355-536de3962603?w=300&h=150&fit=crop'],
            ['Soundcity',        'media',    'https://soundcity.tv',  '/images/sponsors/soundcity.svg'],
            ['Pulse NG',         'media',    'https://pulse.ng',      'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?w=300&h=150&fit=crop'],
            ['Cool FM Lagos',    'media',    'https://coolfm.ng',     'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?w=300&h=150&fit=crop'],
        ];

        Sponsor::truncate();

        foreach ($sponsors as $i => [$name, $tier, $website, $logo]) {
            Sponsor::create([
                'name' => $name,
                'tier' => $tier,
                'website' => $website,
                'logo' => $logo,
                'sort_order' => $i + 1,
                'is_active' => true,
                'description' => "Official {$tier} sponsor for Elite Block Party 2025.",
            ]);
        }
    }
}
