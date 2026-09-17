<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\TicketType;
use Illuminate\Database\Seeder;

class TicketTypeSeeder extends Seeder
{
    public function run(): void
    {
        $event = Event::firstOrCreate(
            ['slug' => 'elite-block-party-2025'],
            [
                'name' => 'Elite Block Party 2025',
                'tagline' => 'The Ultimate Car & Music Festival',
                'description' => 'Where 200+ custom cars, Nigeria\'s hottest artists, and Lagos nightlife collide for one unforgettable night.',
                'venue_name' => 'Eko Hotel Grounds',
                'venue_address' => 'Plot 1415 Adetokunbo Ademola Street',
                'city' => 'Lagos',
                'state' => 'Lagos',
                'country' => 'Nigeria',
                'starts_at' => '2025-12-20 20:00:00',
                'ends_at' => '2025-12-21 04:00:00',
                'doors_open_at' => '2025-12-20 18:00:00',
                'is_active' => true,
                'tickets_on_sale' => true,
            ]
        );

        $types = [
            [
                'name' => 'Regular',
                'description' => 'General admission to the main event.',
                'perks' => ['General admission', 'Access to main stage', 'Access to food village'],
                'online_price' => 12000,
                'door_price' => 17000,
                'quantity_total' => 2000,
                'max_per_order' => 10,
                'sort_order' => 1,
            ],
            [
                'name' => 'VIP',
                'description' => 'Elevated experience with priority access.',
                'perks' => ['Everything in Regular', 'VIP lounge access', 'Priority entry lane', 'Dedicated bar'],
                'online_price' => 25000,
                'door_price' => 30000,
                'quantity_total' => 500,
                'max_per_order' => 6,
                'sort_order' => 2,
            ],
            [
                'name' => 'VVIP',
                'description' => 'The ultimate ELITE experience.',
                'perks' => [
                    'Everything in VIP',
                    'Front-row views',
                    'Private restrooms',
                    'Complimentary welcome drinks',
                    'Afterparty access till sunrise',
                    'Priority valet parking',
                ],
                'online_price' => 40000,
                'door_price' => 45000,
                'quantity_total' => 200,
                'max_per_order' => 4,
                'sort_order' => 3,
            ],
            [
                'name' => 'Table of 4',
                'description' => 'Private table for four with bottle service.',
                'perks' => ['4 VVIP passes', 'Private table', 'Bottle service', 'Dedicated waiter'],
                'online_price' => 220000,
                'door_price' => null,
                'quantity_total' => 30,
                'max_per_order' => 2,
                'sort_order' => 4,
            ],
            [
                'name' => 'Vendor Stall',
                'description' => 'Secure your vendor stall at the event.',
                'perks' => ['Vendor stall space', 'Power supply', 'Vendor pass for 2'],
                'online_price' => 60000,
                'door_price' => null,
                'quantity_total' => 50,
                'max_per_order' => 1,
                'is_vendor_stall' => true,
                'sort_order' => 5,
            ],
        ];

        foreach ($types as $type) {
            TicketType::updateOrCreate(
                ['slug' => str($type['name'])->slug()->toString()],
                array_merge($type, [
                    'event_id' => $event->id,
                    'is_active' => true,
                    'is_vendor_stall' => $type['is_vendor_stall'] ?? false,
                ])
            );
        }
    }
}
