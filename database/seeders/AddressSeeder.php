<?php

namespace Database\Seeders;

use App\Models\Address;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
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
                'name' => 'улица 1, дом 1',
                'affiliate_id' => 1,
            ],
            [
                'name' => 'улица 2, дом 2',
                'affiliate_id' => 2,
            ],
            [
                'name' => 'улица 3, дом 3',
                'affiliate_id' => 3,
            ],
            [
                'name' => 'улица 4, дом 4',
                'affiliate_id' => 1,
            ],
        ];

        foreach ($data as $line) {
            Address::create($line);
        }
    }
}
