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
                'name' => 'Test Yogaland',
                'phone' => '700 778 8990',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod sagittis nisi vel facilisis. Pellentesque id feugiat nisl, vel finibus justo. Integer semper nec ipsum ut malesuada.',
                'city_id' => 1,
            ],
            [
                'name' => 'Test Йога и агоЙ',
                'phone' => '700 778 8991',
                'description' => 'Vestibulum placerat in urna id congue. Donec et scelerisque urna. Sed mattis pellentesque turpis. Donec consectetur viverra felis, id venenatis enim ultrices sed. Etiam quis arcu eu nulla convallis aliquam scelerisque quis lorem. Duis euismod libero ac accumsan accumsan. Proin et porta massa. Praesent elementum diam sit amet massa commodo vestibulum.',
                'city_id' => 1,
            ],
            [
                'name' => 'Test Ноги вверх',
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
