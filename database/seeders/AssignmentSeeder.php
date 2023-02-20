<?php

namespace Database\Seeders;

use App\Models\Assignment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssignmentSeeder extends Seeder
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
                'user_id' => 9,
                'lesson_id' => 1,
            ],
            [
                'user_id' => 9,
                'lesson_id' => 2,
            ],
            [
                'user_id' => 9,
                'lesson_id' => 3,
            ],


            [
                'user_id' => 10,
                'lesson_id' => 5,
            ],
        ];

        foreach ($data as $line) {
            Assignment::create($line);
        }
    }
}
