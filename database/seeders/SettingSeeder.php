<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        Setting::truncate();

        $settings = [
            ['key' => 'site_name', 'value' => 'Elite Block Party', 'group' => 'general', 'type' => 'string'],
            ['key' => 'site_tagline', 'value' => 'Where High-Octane Speed Meets Unfiltered Sound', 'group' => 'general', 'type' => 'string'],
            ['key' => 'contact_email', 'value' => 'info@eliteblockparty.com', 'group' => 'contact', 'type' => 'string'],
            ['key' => 'contact_phone', 'value' => '+234 800 ELITE PARTY', 'group' => 'contact', 'type' => 'string'],
            ['key' => 'event_date', 'value' => '2025-12-20', 'group' => 'event', 'type' => 'string'],
            ['key' => 'event_location', 'value' => 'Eko Hotel & Suites, Victoria Island, Lagos', 'group' => 'event', 'type' => 'string'],
            ['key' => 'ticket_sales_open', 'value' => '1', 'group' => 'ticketing', 'type' => 'boolean'],
            ['key' => 'currency', 'value' => 'NGN', 'group' => 'payment', 'type' => 'string'],
            ['key' => 'currency_symbol', 'value' => '₦', 'group' => 'payment', 'type' => 'string'],
        ];

        foreach ($settings as $s) {
            Setting::create($s);
        }
    }
}
