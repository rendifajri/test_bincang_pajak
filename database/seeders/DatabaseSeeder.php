<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Destination;
use App\Models\Item;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $data = [
                    [
                        'name' => 'Barrington Publisher',
                        'address' => '17 Great Street, London, United Kingdom',
                    ],
                    [
                        'name' => 'PT. Indofood',
                        'address' => 'Jalan Jend. Sudirman, Jakarta',
                    ],
                    [
                        'name' => 'PT. Mayora',
                        'address' => 'Jalan Gatot Subroto, Jakarta',
                    ],
                ];
        Destination::insert($data);
        $data = [
                    [
                        'name' => 'Design',
                        'item_type' => 'Service',
                        'price' => 230000,
                    ],
                    [
                        'name' => 'Development',
                        'item_type' => 'Service',
                        'price' => 330000,
                    ],
                    [
                        'name' => 'Meeting',
                        'item_type' => 'Service',
                        'price' => 60000,
                    ],
                    [
                        'name' => 'Indomie Goreng',
                        'item_type' => 'Makanan',
                        'price' => 2500,
                    ],
                    [
                        'name' => 'Beng-beng',
                        'item_type' => 'Snack',
                        'price' => 1500,
                    ],
                    [
                        'name' => 'Teh Pucuk',
                        'item_type' => 'Minuman',
                        'price' => 3000,
                    ],
                ];
        Item::insert($data);
    }
}
