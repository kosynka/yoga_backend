<?php

namespace Database\Seeders;

use App\Models\Affiliate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AffiliateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Yogaland',
                'phone' => '700 778 8990',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod sagittis nisi vel facilisis',
                'city_id' => 1,
            ],
            [
                'name' => 'VelVet',
                'phone' => '700 778 8991',
                'description' => 'Vestibulum placerat in urna id congue. Donec et scelerisque urna. Sed mattis pellentesque turpis',
                'city_id' => 1,
            ],
            [
                'name' => 'АэроЙога',
                'phone' => '700 778 8992',
                'description' => 'Quisque posuere suscipit malesuada. Morbi semper euismod venenatis. Vivamus fringilla lorem tempus, fermentum tortor vitae, tempor lacus',
                'city_id' => 1,
            ],
        ];

        foreach ($data as $line) {
            Affiliate::create($line);
        }
    }
}
