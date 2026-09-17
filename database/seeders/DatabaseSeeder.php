<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        $this->call([
            AdminUserSeeder::class,
            EventSeeder::class,
            TicketTypeSeeder::class,
            ArtistSeeder::class,
            SponsorSeeder::class,
            ExperienceSeeder::class,
            PostCategorySeeder::class,
            PostSeeder::class,
            ReviewSeeder::class,
            AnnouncementSeeder::class,
            SettingSeeder::class,
            VendorSeeder::class,
            GallerySeeder::class,
        ]);

        Schema::enableForeignKeyConstraints();
    }
}
