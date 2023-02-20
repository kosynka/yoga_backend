<?php

namespace Database\Seeders;

use App\Models\Lesson;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
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
                'type_id' => 1,
                'instructor_id' => 5,
                'starts_at' => '2023-02-27 14:00',
                'comment' => 'Не забудьте принести перчатки',
            ],
            [
                'type_id' => 1,
                'instructor_id' => 5,
                'starts_at' => '2023-02-27 15:00',
            ],
            [
                'type_id' => 1,
                'instructor_id' => 5,
                'starts_at' => '2023-02-27 16:00',
            ],


            [
                'type_id' => 2,
                'instructor_id' => 6,
                'starts_at' => '2023-02-25 16:00',
            ],
            [
                'type_id' => 2,
                'instructor_id' => 6,
                'starts_at' => '2023-02-25 17:00',
            ],


            [
                'type_id' => 3,
                'instructor_id' => 7,
                'starts_at' => '2023-02-25 12:00',
            ],
            [
                'type_id' => 3,
                'instructor_id' => 7,
                'starts_at' => '2023-02-25 13:00',
            ],
            [
                'type_id' => 3,
                'instructor_id' => 7,
                'starts_at' => '2023-02-25 18:00',
            ],
            [
                'type_id' => 3,
                'instructor_id' => 7,
                'starts_at' => '2023-02-25 19:00',
            ],


            [
                'type_id' => 1,
                'instructor_id' => 8,
                'starts_at' => '2023-02-26 20:00',
            ],
        ];

        foreach ($data as $line) {
            Lesson::create($line);
        }
    }
}
