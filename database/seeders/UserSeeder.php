<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
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
                'role' => 'ADMIN',
                'name' => 'Super Admin',
                'phone' => '777 777 7777',
                'password' => Hash::make('admin'),
                'phone_verified_at' => '2023-01-01 01:05:22',
                // 'email' => 'sayat.kaldarbekov.00@gmail.com',
                // 'email_verified_at' => '2023-01-01 01:05:22',
            ],
            [
                'role' => 'ADMIN',
                'name' => 'Admin of "Test Yogaland"',
                'phone' => '771 777 7777',
                'password' => Hash::make('admin'),
                'phone_verified_at' => '2023-01-01 01:05:22',
                // 'email' => 'sayat.kaldarbekov.00@gmail.com',
                // 'email_verified_at' => '2023-01-01 01:05:22',
            ],
            [
                'role' => 'ADMIN',
                'name' => 'Admin of "Test Йога и агоЙ"',
                'phone' => '771 777 7777',
                'password' => Hash::make('admin'),
                'phone_verified_at' => '2023-01-01 01:05:22',
                // 'email' => 'sayat.kaldarbekov.00@gmail.com',
                // 'email_verified_at' => '2023-01-01 01:05:22',
            ],
            [
                'role' => 'ADMIN',
                'name' => 'Admin of "Test Ноги вверх"',
                'phone' => '772 777 7777',
                'password' => Hash::make('admin'),
                'phone_verified_at' => '2023-01-01 01:05:22',
                // 'email' => 'sayat.kaldarbekov.00@gmail.com',
                // 'email_verified_at' => '2023-01-01 01:05:22',
            ],
            [
                'role' => 'INSTRUCTOR',
                'name' => 'Тестовый инструктор 707 865 0366',
                'phone' => '707 865 0366',
                'phone_verified_at' => '2023-01-01 01:05:22',
                // 'email' => 'sayat.kaldarbek@gmail.com',
                // 'password' => Hash::make('123'),
                // 'email_verified_at' => '2023-01-01 01:05:22',
            ],
            [
                'role' => 'INSTRUCTOR',
                'name' => 'Тестовый инструктор 700 100 2001',
                'phone' => '700 100 2001',
                'phone_verified_at' => '2023-01-01 01:05:22',
                // 'email' => 'sayat.kaldarbek@gmail.com',
                // 'password' => Hash::make('123'),
                // 'email_verified_at' => '2023-01-01 01:05:22',
            ],
            [
                'role' => 'INSTRUCTOR',
                'name' => 'Тестовый инструктор 700 100 2002',
                'phone' => '700 100 2002',
                'phone_verified_at' => '2023-01-01 01:05:22',
                // 'email' => 'sayat.kaldarbek@gmail.com',
                // 'password' => Hash::make('123'),
                // 'email_verified_at' => '2023-01-01 01:05:22',
            ],
            [
                'role' => 'INSTRUCTOR',
                'name' => 'Тестовый инструктор 700 100 2003',
                'phone' => '700 100 2003',
                'phone_verified_at' => '2023-01-01 01:05:22',
                // 'email' => 'sayat.kaldarbek@gmail.com',
                // 'password' => Hash::make('123'),
                // 'email_verified_at' => '2023-01-01 01:05:22',
            ],
            [
                'role' => 'USER',
                'name' => 'Тестовый пользователь 702 236 3206',
                'phone' => '702 236 3206',
                'phone_verified_at' => '2023-01-01 01:05:22',
                // 'email' => 'sayat.kaldarbekov.00@gmail.com',
                // 'password' => Hash::make('123'),
                // 'email_verified_at' => '2023-01-01 01:05:22',
            ],
            [
                'role' => 'USER',
                'name' => 'Тестовый пользователь 707 405 4407',
                'phone' => '707 405 4407',
                'phone_verified_at' => '2023-01-01 01:05:22',
                // 'email' => 'dastan.dastan@gmail.com',
                // 'password' => Hash::make('123'),
                // 'email_verified_at' => '2023-01-01 01:05:22',
            ],
        ];

        foreach ($data as $column) {
            User::create($column);
        }
    }
}
