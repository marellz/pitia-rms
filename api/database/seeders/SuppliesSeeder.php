<?php

namespace Database\Seeders;

use App\Models\Stock\Supplies;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SuppliesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $items = [
            [
                'name' => 'Coffee',
                'description' => '10g satchets',
                'units' => 50,
                'cost_per_unit' => 5
            ],
            [
                'name' => 'Tea leaves',
                'description' => '100g bags',
                'units' => 3,
                'cost_per_unit' => 100
            ],
            [
                'name' => 'Tomatoes',
                'description' => '',
                'units' => 10,
                'cost_per_unit' => 10
            ],
            [
                'name' => 'Onions',
                'description' => '',
                'units' => 10,
                'cost_per_unit' => 20
            ],
            [
                'name' => 'Garlic',
                'description' => '',
                'units' => 5,
                'cost_per_unit' => 30
            ],
            [
                'name' => 'Cabbage',
                'description' => '',
                'units' => 3,
                'cost_per_unit' => 70
            ],
        ];

        foreach ($items as $item) {
            Supplies::create($item);
        }
    }
}
