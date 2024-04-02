<?php

namespace Database\Seeders;

use App\Models\Serving\Serving;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $items = [
            [
                'name' => 'Pilau',
                'units' => 4,
                'stock_id' => 1,
            ],
            [
                'name' => 'Rice',
                'units' => 15,
                'stock_id' => 1,
            ],
            [
                'name' => 'Beef',
                'units' => 10,
                'stock_id' => 3,
            ],
            [
                'name' => 'Ugali',
                'units' => 10,
                'stock_id' => 2,
            ],
            [
                'name' => 'Chapo',
                'units' => 10,
                'stock_id' => 6,
            ],
            [
                'name' => 'Cabbage',
                'units' => 10,
                'supplies_id' => 6,
            ],
            [
                'name' => 'Soda',
                'units' => 12,
                'stock_id' => 5,
                'unit_type' => 'bottle'
            ],
            [
                'name' => 'Tea',
                'supplies_id' => 2,
                'units' => 4,
                'unit_type' => 'cups'
            ],
            [
                'name' => 'Coffee',
                'units' => 10,
                'supplies_id' => 1,
                'unit_type' => 'cups'
            ],
            [
                'name'=> 'Salad',
                'supplies_id' => 2,
                'units' => 10,
                /**
                 * todo: polymorphic table for values with multiple
                 * supplies_id/stock_id
                 * */  
                // 'stock_id/supplies_id' => null , 
            ],
        ];

        foreach ($items as $item) {
            Serving::create($item);
        }
    }
}
