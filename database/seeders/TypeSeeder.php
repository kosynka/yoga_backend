<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
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
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod sagittis nisi vel facilisis. Pellentesque id feugiat nisl, vel finibus justo. Integer semper nec ipsum ut malesuada. Donec vel dictum sem. Vestibulum in nunc nec dolor imperdiet laoreet efficitur quis diam. Cras lobortis mollis nunc sit amet blandit. Etiam quis vehicula leo, eu mollis ipsum. Donec dignissim libero eget tincidunt tristique. Nunc nisl odio, gravida at est eu, tempus elementum libero. Etiam urna nunc, blandit sit amet neque et, ornare bibendum dolor. Nam volutpat metus non mattis ullamcorper. Maecenas auctor justo a diam aliquam, ac sodales nisl gravida.',
            ],
            [
                'name' => 'Test Йога и агоЙ',
                'description' => 'Vestibulum placerat in urna id congue. Donec et scelerisque urna. Sed mattis pellentesque turpis. Donec consectetur viverra felis, id venenatis enim ultrices sed. Etiam quis arcu eu nulla convallis aliquam scelerisque quis lorem. Duis euismod libero ac accumsan accumsan. Proin et porta massa. Praesent elementum diam sit amet massa commodo vestibulum. In pretium neque nunc, quis convallis ex efficitur pretium. Cras hendrerit ipsum vitae sapien vestibulum mollis. Proin luctus eros nec felis ornare, ac dapibus metus ornare. Phasellus eleifend venenatis mattis. Morbi porttitor rhoncus metus. Aenean nec felis nisi.',
            ],
            [
                'name' => 'Test Ноги вверх',
                'description' => 'Quisque posuere suscipit malesuada. Morbi semper euismod venenatis. Vivamus fringilla lorem tempus, fermentum tortor vitae, tempor lacus',
            ],
        ];

        foreach ($data as $line) {
            Type::create($line);
        }
    }
}
