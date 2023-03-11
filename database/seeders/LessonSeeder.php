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
                'starts_at' => '2023-03-17 14:00',
                'continuance' => 50,
                'participants_limitation' => 10,
                'comment' => 'Не забудьте принести полотенце',
            ],
            [
                'type_id' => 1,
                'instructor_id' => 5,
                'starts_at' => '2023-03-17 15:00',
                'continuance' => 50,
                'participants_limitation' => 10,
            ],
            [
                'type_id' => 1,
                'instructor_id' => 5,
                'starts_at' => '2023-03-17 16:00',
                'continuance' => 50,
                'participants_limitation' => 10,
            ],


            [
                'type_id' => 2,
                'instructor_id' => 6,
                'starts_at' => '2023-03-15 16:00',
                'continuance' => 50,
                'participants_limitation' => 10,
                'comment' => 'Новый супер урок!!!',
            ],
            [
                'type_id' => 2,
                'instructor_id' => 6,
                'starts_at' => '2023-03-15 17:00',
                'continuance' => 50,
                'participants_limitation' => 10,
            ],


            [
                'type_id' => 3,
                'instructor_id' => 7,
                'starts_at' => '2023-03-15 12:00',
                'continuance' => 50,
                'participants_limitation' => 10,
            ],
            [
                'type_id' => 3,
                'instructor_id' => 7,
                'starts_at' => '2023-03-15 13:00',
                'continuance' => 50,
                'participants_limitation' => 10,
            ],
            [
                'type_id' => 3,
                'instructor_id' => 7,
                'starts_at' => '2023-03-15 18:00',
                'continuance' => 50,
                'participants_limitation' => 10,
            ],
            [
                'type_id' => 3,
                'instructor_id' => 7,
                'starts_at' => '2023-03-11 19:00',
                'continuance' => 50,
                'participants_limitation' => 10,
            ],


            [
                'type_id' => 1,
                'instructor_id' => 8,
                'starts_at' => '2023-03-10 20:00',
                'continuance' => 50,
                'participants_limitation' => 10,
            ],
        ];

        foreach ($data as $line) {
            Lesson::create($line);
        }
    }
}
