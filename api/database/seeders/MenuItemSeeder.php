<?php

namespace Database\Seeders;

use App\Models\Menu\MenuItem;
use App\Models\Menu\MenuItemCategory;
use App\Models\Serving\MenuItemServing;
use App\Models\Serving\Serving;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // 'Meals', => '[Ugali Beef'], ['Rice Beef'] ['Pilau'], ['Pilau Beef']
        // 'Snacks', => ['Chapo']
        // 'Drinks', => ['Soda']
        // 'Beverages' => ['Tea', 'Coffee']


        $items = [
            [
                'name' => 'Ugali Beef',
                'category' => 'Meals',
                'price' => 150,
                'servings' => ['Ugali', 'Beef', 'Salad'],
            ],
            [
                'name' => 'Rice Beef',
                'category' => 'Meals',
                'price' => 150,
                'servings' => ['Rice', 'Beef', 'Salad'],
            ],
            [
                'name' => 'Pilau',
                'category' => 'Meals',
                'servings' => ['Pilau', 'Salad'],
                'price' => 180,
            ],
            [
                'name' => 'Pilau Beef',
                'category' => 'Meals',
                'servings' => ['Pilau', 'Beef', 'Salad'],
                'price' => 200,
            ],
            [
                'name' => 'Chapo',
                'category' => 'Snacks',
                'servings' => ['Chapo'],
                'price' => 30,
            ],
            [
                'name' => 'Soda',
                'category' => 'Drinks',
                'servings' => ['Soda'],
                'price' => 50,
            ],
            [
                'name' => 'Tea',
                'category' => 'Beverages',
                'servings' => ['Tea'],
                'price' => 30,
            ],
            [
                'name' => 'Coffee',
                'category' => 'Beverages',
                'servings' => ['Coffee'],
                'price' => 30,
            ],
        ];

        foreach ($items as $item) {
            $category = MenuItemCategory::where('name', $item['category'])->firstOrFail();
            $menuItem = MenuItem::create([
                "name" => $item['name'],
                "price" => $item['price'],
                "menu_item_category_id" => $category->id,
            ]);

            foreach ($item['servings'] as $serving_name) {
                $serving = Serving::where('name', $serving_name)->firstOrFail();

                MenuItemServing::create([
                    'menu_item_id' => $menuItem->id,
                    'serving_id' => $serving->id,
                ]);
            }
        }
    }
}
