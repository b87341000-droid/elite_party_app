<?php

namespace Database\Seeders;

use App\Models\Experience;
use Illuminate\Database\Seeder;

class ExperienceSeeder extends Seeder
{
    public function run(): void
    {
        Experience::truncate();

        $experiences = [
            [
                'title' => 'Drift Arena & Stunt Pit',
                'slug' => 'drift-arena-stunt-pit',
                'description' => 'Pro drift battles, burnout pits, and live tyre smoke shows with championship drift pilots shredding rubber on custom tracks.',
                'icon' => 'flame',
                'image' => '/images/experiences/drift.jpg',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Supercar Paddock & VIP Vault',
                'slug' => 'supercar-paddock-vip-vault',
                'description' => 'Over 150 rarest hypercars, tuned JDMs, classic American muscle, and exotic builds with private owner walkarounds.',
                'icon' => 'car',
                'image' => '/images/experiences/supercars.jpg',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Neon Stage & Bass Stage',
                'slug' => 'neon-stage-bass-stage',
                'description' => '100,000 watts of crystal sound, laser mapping, fire pyrotechnics, and headlining sets by Africa\'s biggest afrobeat and hip-hop icons.',
                'icon' => 'music',
                'image' => '/images/experiences/stage.jpg',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Street Heat Food District',
                'slug' => 'street-heat-food-district',
                'description' => 'Curated street cuisine, smoked brisket, spicy suya grills, artisan cocktail bars, and craft beer trucks running till 4 AM.',
                'icon' => 'utensils',
                'image' => '/images/experiences/food.jpg',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'Pit Lane Merch & Fit Check',
                'slug' => 'pit-lane-merch-fit-check',
                'description' => 'Exclusive limited-run Elite Block Party racing jackets, custom tees, sneaker drops, and red-carpet fit check photo booth.',
                'icon' => 'shirt',
                'image' => '/images/experiences/merch.jpg',
                'sort_order' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($experiences as $exp) {
            Experience::create($exp);
        }
    }
}
