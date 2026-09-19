<?php

namespace Database\Seeders;

use App\Models\Sponsor;
use Illuminate\Database\Seeder;

class SponsorSeeder extends Seeder
{
    public function run(): void
    {
        $sponsors = [
            ['Martell',          'platinum', 'https://martell.com'],
            ['Guinness Nigeria', 'platinum', 'https://guinness.com'],
            ['MTN Nigeria',      'gold',     'https://mtn.ng'],
            ['Airtel',           'gold',     'https://airtel.ng'],
            ['Red Bull',         'silver',   'https://redbull.com'],
            ['Heineken',         'silver',   'https://heineken.com'],
            ['Pulse NG',         'media',    'https://pulse.ng'],
            ['Cool FM Lagos',    'media',    'https://coolfm.ng'],
        ];

        // Remove any old/stale sample sponsors so counts match expected 8 sponsors
        Sponsor::whereNotIn('name', array_column($sponsors, 0))->delete();

        foreach ($sponsors as $i => [$name, $tier, $website]) {
            Sponsor::updateOrCreate(
                ['name' => $name],
                [
                    'tier' => $tier,
                    'website' => $website,
                    'sort_order' => $i + 1,
                    'is_active' => true,
                ]
            );
        }
    }
}
