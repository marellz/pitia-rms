<?php

namespace Database\Seeders;

use App\Models\Menu\MenuItemCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuItemCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $items = [
            'Meals',
            'Snacks',
            'Drinks',
            'Beverages'
        ];

        foreach ($items as $item) {
            MenuItemCategory::create(['name'=>$item]);
        }
    }
}
