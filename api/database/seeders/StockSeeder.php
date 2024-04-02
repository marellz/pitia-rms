<?php

namespace Database\Seeders;

use App\Models\Stock\Stock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $items = [
            [
                'name' => 'Rice',
                'cost_per_unit' => 142,
                'units' => 10,
            ],
            [
                'name' => 'Ugali flour',
                'cost_per_unit' => 67,
                'units' => 24,
            ],
            [
                'name' => 'Beef',
                'units' => 5,
                'cost_per_unit' => 500
            ],
            [
                'name' => 'Milk',
                'units' => 6,
                'cost_per_unit' => 75,
                'unit_type' => 'L',
            ],
            [
                'name' => 'Soda',
                'units' => 6,
                'cost_per_unit' => 40,
                'unit_type' => 'ml',
            ],
            [
                'name' => 'Chapo',
                'units' => 12,
                'cost_per_unit' => 30,
                'unit_type' => 'ml',
            ],
            
        ];

        foreach ($items as $item) {
            Stock::create($item);
        }
    }
}
