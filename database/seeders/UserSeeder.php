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
                // 'email' => 'sayat.kaldarbekov.00@gmail.com',
                // 'email_verified_at' => '2023-01-01 01:05:22',
            ],
            [
                'role' => 'INSTRUCTOR',
                'name' => 'инст7078650366',
                'phone' => '707 865 0366',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod sagittis nisi vel facilisis.',
                'works_in_affiliate_id' => 1,
                // 'email' => 'sayat.kaldarbek@gmail.com',
                // 'password' => Hash::make('123'),
                // 'email_verified_at' => '2023-01-01 01:05:22',
            ],
            [
                'role' => 'INSTRUCTOR',
                'name' => 'инст7001002001',
                'phone' => '700 100 2001',
                'works_in_affiliate_id' => 1,
                // 'email' => 'sayat.kaldarbek@gmail.com',
                // 'password' => Hash::make('123'),
                // 'email_verified_at' => '2023-01-01 01:05:22',
            ],
            [
                'role' => 'INSTRUCTOR',
                'name' => 'инст7001002002',
                'phone' => '700 100 2002',
                'description' => 'Vestibulum placerat in urna id congue. Donec et scelerisque urna. Sed mattis pellentesque turpis. Donec consectetur viverra felis, id venenatis enim ultrices sed.',
                'works_in_affiliate_id' => 2,
                // 'email' => 'sayat.kaldarbek@gmail.com',
                // 'password' => Hash::make('123'),
                // 'email_verified_at' => '2023-01-01 01:05:22',
            ],
            [
                'role' => 'INSTRUCTOR',
                'name' => 'инст7001002003',
                'phone' => '700 100 2003',
                'works_in_affiliate_id' => 3,
                // 'email' => 'sayat.kaldarbek@gmail.com',
                // 'password' => Hash::make('123'),
                // 'email_verified_at' => '2023-01-01 01:05:22',
            ],
            [
                'role' => 'USER',
                'name' => 'польз7022363206',
                'phone' => '702 236 3206',
                'favorite_affiliate_id' => 1,
                // 'email' => 'sayat.kaldarbekov.00@gmail.com',
                // 'password' => Hash::make('123'),
                // 'email_verified_at' => '2023-01-01 01:05:22',
            ],
            [
                'role' => 'USER',
                'name' => 'польз7074054407',
                'phone' => '707 405 4407',
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
