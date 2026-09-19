<?php

namespace Database\Seeders;

use App\Models\Artist;
use App\Models\Event;
use Illuminate\Database\Seeder;

class ArtistSeeder extends Seeder
{
    public function run(): void
    {
        $event = Event::first();

        $artists = [
            ['Burna Boy', 'Burna Boy', 'performer', true],
            ['Rema',      'Rema',      'performer', true],
            ['Tems',      'Tems',      'performer', true],
            ['Wizkid',    'Wizkid',    'performer', true],
            ['DJ Spinall','Spinall',   'dj',        false],
            ['DJ Cuppy',  'Cuppy',     'dj',        false],
            ['Ayra Starr','Ayra Starr','performer', false],
            ['Odumodublvck','Odumodu', 'performer', false],
        ];

        foreach ($artists as $i => [$name, $stage, $role, $headliner]) {
            Artist::updateOrCreate(
                ['name' => $name],
                [
                    'event_id'     => $event?->id,
                    'stage_name'   => $stage,
                    'role'         => $role,
                    'is_headliner' => $headliner,
                    'sort_order'   => $i + 1,
                    'is_active'    => true,
                ]
            );
        }
    }
}