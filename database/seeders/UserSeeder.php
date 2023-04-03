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
            ],
            [
                'role' => 'INSTRUCTOR',
                'name' => 'инст7078650366',
                'phone' => '707 865 0366',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod sagittis nisi vel facilisis.',
                'works_in_affiliate_id' => 1,
                'password' => Hash::make('123'),
            ],
            [
                'role' => 'INSTRUCTOR',
                'name' => 'инст7001002001',
                'phone' => '700 100 2001',
                'works_in_affiliate_id' => 1,
                'password' => Hash::make('123'),
            ],
            [
                'role' => 'INSTRUCTOR',
                'name' => 'инст7001002002',
                'phone' => '700 100 2002',
                'description' => 'Vestibulum placerat in urna id congue. Donec et scelerisque urna. Sed mattis pellentesque turpis. Donec consectetur viverra felis, id venenatis enim ultrices sed.',
                'works_in_affiliate_id' => 2,
                'password' => Hash::make('123'),
            ],
            [
                'role' => 'INSTRUCTOR',
                'name' => 'инст7001002003',
                'phone' => '700 100 2003',
                'works_in_affiliate_id' => 3,
                'password' => Hash::make('123'),
            ],
            [
                'role' => 'USER',
                'name' => 'польз7022363206',
                'phone' => '702 236 3206',
                'package_id' => 1,
                'expires_at' => '2023-05-03',
                'visits_left' => 12,
                'favorite_affiliate_id' => 1,
                'password' => Hash::make('123'),
            ],
            [
                'role' => 'USER',
                'name' => 'польз7074054407',
                'phone' => '707 405 4407',
                'package_id' => 2,
                'expires_at' => '2023-03-06',
                'visits_left' => 3,
                'password' => Hash::make('123'),
            ],
            [
                'role' => 'ADMIN',
                'name' => 'Admin Yogaland',
                'phone' => '700 778 8990',
                'password' => Hash::make('admin'),
            ],
            [
                'role' => 'ADMIN',
                'name' => 'Admin VelVet',
                'phone' => '700 778 8991',
                'password' => Hash::make('admin'),
            ],
            [
                'role' => 'ADMIN',
                'name' => 'Admin АэроЙога',
                'phone' => '700 778 8992',
                'password' => Hash::make('admin'),
            ],
        ];

        foreach ($data as $column) {
            User::create($column);
        }
    }
}
