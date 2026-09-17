<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\TicketType;
use Illuminate\Database\Seeder;

class TicketTypeSeeder extends Seeder
{
    public function run(): void
    {
        TicketType::truncate();

        $event = Event::where('slug', 'elite-block-party-2025')->firstOrFail();

        $tiers = [
            [
                'name' => 'Regular',
                'slug' => 'regular',
                'description' => 'General admission to the car showcase, live performances, and street food court. The vibe starts here.',
                'online_price' => 12000,
                'door_price' => 15000,
                'quantity_total' => 5000,
                'quantity_sold' => 850,
                'max_per_order' => 10,
                'sort_order' => 1,
                'perks' => ['General Area Access', 'Live Performances', 'Car Showcase', 'Street Food Court'],
                'is_active' => true,
                'is_vendor_stall' => false,
            ],
            [
                'name' => 'VIP',
                'slug' => 'vip',
                'description' => 'Premium access with reserved viewing area, VIP lounge, and one complimentary drink. Stand out.',
                'online_price' => 25000,
                'door_price' => 30000,
                'quantity_total' => 2000,
                'quantity_sold' => 620,
                'max_per_order' => 6,
                'sort_order' => 2,
                'perks' => ['VIP Lounge Access', 'Reserved Viewing Area', 'Complimentary Drink', 'Priority Entry', 'Car Showcase Access'],
                'is_active' => true,
                'is_vendor_stall' => false,
            ],
            [
                'name' => 'VVIP',
                'slug' => 'vvip',
                'description' => 'Exclusive lounge, 3-hour open bar, meet & greet access, dedicated concierge, VIP parking, and giftbag.',
                'online_price' => 40000,
                'door_price' => 50000,
                'quantity_total' => 500,
                'quantity_sold' => 210,
                'max_per_order' => 4,
                'sort_order' => 3,
                'perks' => ['Exclusive VVIP Lounge', 'Open Bar (3hrs)', 'Meet & Greet Access', 'Dedicated Concierge', 'VIP Parking', 'Premium Giftbag'],
                'is_active' => true,
                'is_vendor_stall' => false,
            ],
            [
                'name' => 'Table of 4',
                'slug' => 'table-of-4',
                'description' => 'Private table for 4, full-night open bar, premium food platter, dedicated waiter, VIP parking x2, and exclusive giftbags.',
                'online_price' => 220000,
                'door_price' => 250000,
                'quantity_total' => 100,
                'quantity_sold' => 45,
                'max_per_order' => 1,
                'sort_order' => 4,
                'perks' => ['Private Table for 4', 'Open Bar (Full Night)', 'Premium Food Platter', 'Dedicated Waiter', 'VIP Parking x2', 'Exclusive Giftbags x4', 'Priority Access All Areas'],
                'is_active' => true,
                'is_vendor_stall' => false,
            ],
            [
                'name' => 'Vendor Stall',
                'slug' => 'vendor-stall',
                'description' => 'Premium vendor stall space with electricity, branding opportunities, and access to 10,000+ paying guests.',
                'online_price' => 150000,
                'door_price' => null,
                'quantity_total' => 80,
                'quantity_sold' => 32,
                'max_per_order' => 1,
                'sort_order' => 5,
                'perks' => ['3x3m Stall Space', 'Electricity Supply', '2 Vendor Passes', 'Setup from 10AM', 'Logo on Vendor Map'],
                'is_active' => true,
                'is_vendor_stall' => true,
            ],
        ];

        foreach ($tiers as $tier) {
            $event->ticketTypes()->create($tier);
        }
    }
}
