<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            SubjectSeeder::class,
            AdSeeder::class,
            ArticleSeeder::class,
            OrganisasiSeeder::class,
            FormerPrincipalSeeder::class,
            FacilitySeeder::class,
            AchievementSeeder::class,
        ]);

        // Seed default school settings if not present
        if (\App\Models\SchoolSetting::count() === 0) {
            \App\Models\SchoolSetting::createDefault();
        }
    }
}
