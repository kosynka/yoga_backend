<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
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
                'name' => 'Pro',
                'classes_amount' => 12,
                'price' => 20000,
            ],
            [
                'name' => 'Medium',
                'classes_amount' => 8,
                'price' => 15000,
            ],
            [
                'name' => 'Light',
                'classes_amount' => 4,
                'price' => 9000,
            ],
        ];

        foreach ($data as $line) {
            Package::create($line);
        }
    }
}
