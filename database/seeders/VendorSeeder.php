<?php

namespace Database\Seeders;

use App\Models\VendorApplication;
use Illuminate\Database\Seeder;

class VendorSeeder extends Seeder
{
    public function run(): void
    {
        VendorApplication::truncate();

        $vendors = [
            [
                'type' => 'food',
                'business_name' => 'Smokey Bones BBQ & Suya Pit',
                'contact_name' => 'Chef Tunde',
                'email' => 'tunde@smokeybones.ng',
                'phone' => '+2348011223344',
                'description' => 'Authentic flame-grilled Texas brisket meets spicy Lagos street suya. Served with custom pepper glazes.',
                'website' => 'https://smokeybones.ng',
                'instagram' => '@smokeybonesbbq',
                'status' => 'approved',
                'payment_status' => 'paid',
            ],
            [
                'type' => 'merchandise',
                'business_name' => 'Midnight Velocity Apparel',
                'contact_name' => 'Kemi Davies',
                'email' => 'kemi@midnightvelocity.com',
                'phone' => '+2348022334455',
                'description' => 'Motorsport-inspired streetwear, oversized graphic hoodies, racing jackets, and limited festival drop tees.',
                'website' => 'https://midnightvelocity.com',
                'instagram' => '@midnightvelocity',
                'status' => 'approved',
                'payment_status' => 'paid',
            ],
            [
                'type' => 'drinks',
                'business_name' => 'Nitro Bar & Craft Mocktails',
                'contact_name' => 'Femi Cole',
                'email' => 'femi@nitrobar.ng',
                'phone' => '+2348033445566',
                'description' => 'Liquid nitrogen infused signature cocktails, smoked bourbon mixes, and premium cold-brew energy refreshments.',
                'website' => 'https://nitrobar.ng',
                'instagram' => '@nitrobarlagos',
                'status' => 'approved',
                'payment_status' => 'paid',
            ],
        ];

        foreach ($vendors as $v) {
            VendorApplication::create($v);
        }
    }
}
