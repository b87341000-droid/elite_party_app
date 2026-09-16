<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@eliteblockparty.com'],
            [
                'name' => 'Elite Admin',
                'password' => Hash::make('EliteAdmin@2025'),
                'role' => 'admin',
                'phone' => '+2348000000000',
            ]
        );

        User::updateOrCreate(
            ['email' => 'vendor@eliteblockparty.com'],
            [
                'name' => 'Test Vendor',
                'password' => Hash::make('VendorPass@2025'),
                'role' => 'vendor',
                'phone' => '+2348000000001',
            ]
        );
    }
}
