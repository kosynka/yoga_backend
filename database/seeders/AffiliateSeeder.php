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
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod sagittis nisi vel facilisis. Pellentesque id feugiat nisl, vel finibus justo. Integer semper nec ipsum ut malesuada.',
                'address' => 'Улица А, дом 1, этаж 1',
                'city_id' => 1,
                'master_id' => 2,
            ],
            [
                'name' => 'Test Йога и агоЙ',
                'description' => 'Vestibulum placerat in urna id congue. Donec et scelerisque urna. Sed mattis pellentesque turpis. Donec consectetur viverra felis, id venenatis enim ultrices sed. Etiam quis arcu eu nulla convallis aliquam scelerisque quis lorem. Duis euismod libero ac accumsan accumsan. Proin et porta massa. Praesent elementum diam sit amet massa commodo vestibulum.',
                'address' => 'Улица Б, дом 2, этаж 2',
                'city_id' => 1,
                'master_id' => 3,
            ],
            [
                'name' => 'Test Ноги вверх',
                'description' => 'Quisque posuere suscipit malesuada. Morbi semper euismod venenatis. Vivamus fringilla lorem tempus, fermentum tortor vitae, tempor lacus',
                'address' => 'Улица Г, дом 3, этаж 3',
                'city_id' => 1,
                'master_id' => 4,
            ],
        ];

        foreach ($data as $line) {
            Affiliate::create($line);
        }
    }
}
