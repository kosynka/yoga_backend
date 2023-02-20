<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            CitySeeder::class,
            UserSeeder::class,
            TypeSeeder::class,
            AffiliateSeeder::class,
            LessonSeeder::class,
            AssignmentSeeder::class,
        ]);
    }
}
