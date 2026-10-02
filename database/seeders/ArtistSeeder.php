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
            ['Asake',         'Asake',         'performer', true,  'images/artists/asake.jpg'],
            ['Burna Boy',     'Burna Boy',     'performer', true,  'images/artists/burna.jpg'],
            ['Wizkid',        'Wizkid',        'performer', true,  'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=600&h=600&fit=crop&crop=face'],
            ['Rema',          'Rema',          'performer', true,  'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=600&h=600&fit=crop&crop=face'],
            ['Tems',          'Tems',          'performer', true,  'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=600&h=600&fit=crop&crop=face'],
            ['Ayra Starr',    'Ayra Starr',    'performer', false, 'https://images.unsplash.com/photo-1531746020798-e6953c6e8e04?w=600&h=600&fit=crop&crop=face'],
            ['DJ Spinall',    'DJ Spinall',    'dj',        false, 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=600&h=600&fit=crop&crop=face'],
            ['DJ Cuppy',      'DJ Cuppy',      'dj',        false, 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=600&h=600&fit=crop&crop=face'],
            ['Odumodublvck',  'Odumodublvck',  'performer', false, 'https://images.unsplash.com/photo-1501196354995-cbb51c65aaea?w=600&h=600&fit=crop&crop=face'],
            ['Tiwa Savage',   'Tiwa Savage',   'performer', false, 'https://images.unsplash.com/photo-1524504388940-b1c1722653e1?w=600&h=600&fit=crop&crop=face'],
            ['Shallipopi',    'Shallipopi',    'performer', false, 'https://images.unsplash.com/photo-1492562080023-ab3db95bfbce?w=600&h=600&fit=crop&crop=face'],
            ['Olamide',       'Baddo',         'performer', false, 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?w=600&h=600&fit=crop&crop=face'],
        ];

        // Clean existing artist records to avoid case-duplicates and populate fresh
        Artist::truncate();

        foreach ($artists as $i => [$name, $stage, $role, $headliner, $photo]) {
            Artist::create([
                'event_id'     => $event?->id,
                'name'         => $name,
                'stage_name'   => $stage,
                'role'         => $role,
                'is_headliner' => $headliner,
                'sort_order'   => $i + 1,
                'is_active'    => true,
                'photo'        => $photo,
                'bio'          => $this->getBio($name),
            ]);
        }
    }

    private function getBio(string $name): string
    {
        $bios = [
            'Asake' => 'The definitive sound of modern Amapiano-infused Afrobeats. Known for electrifying live performances, crowd-surfing energy, and record-breaking anthems.',
            'Burna Boy' => 'Grammy-winning Nigerian superstar known for his fusion of Afrobeats, reggae, and hip-hop. One of the most internationally recognized African artists.',
            'Rema' => 'Rising Afrobeats sensation who took the world by storm with hits like "Calm Down" and "Iron Man". A true musical innovator and rave pioneer.',
            'Tems' => 'Soulful vocalist and songwriter whose unique sound has earned collaborations with Wizkid, Drake, and Future.',
            'Wizkid' => 'Afrobeats pioneer and global icon who helped bring Nigerian music to international mainstream audiences.',
            'DJ Spinall' => 'The Top Boy DJ known for his signature cap, high-voltage turntable sets, and chart-topping collaborations.',
            'DJ Cuppy' => 'International DJ, producer, and entrepreneur who has rocked festival stages across Lagos, London, and Dubai.',
            'Ayra Starr' => 'Young and talented vocalist signed to Mavin Records, known for celestial vocals, fashion-forward presence, and viral hits.',
            'Odumodublvck' => 'Hardcore hip-hop powerhouse delivering raw energy, gritty drill rhythms, and authentic street narratives.',
            'Tiwa Savage' => 'The Queen of Afrobeats delivering sultry melodies, world-class choreography, and legendary stage command.',
            'Shallipopi' => 'Evian sensation turning street slang into irresistible club hits that set crowds ablaze.',
            'Olamide' => 'Street rap legend and YBNL boss whose catalog of anthems has dominated West African parties for over a decade.',
        ];

        return $bios[$name] ?? 'Talented artist bringing supreme energy to the Elite Block Party stage.';
    }
}