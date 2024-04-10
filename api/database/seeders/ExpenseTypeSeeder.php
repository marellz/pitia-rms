<?php

namespace Database\Seeders;

use App\Models\Expense\ExpenseType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExpenseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $items = [
            'Stock & supplies',
            'Bills & utilities',
            'Other',
        ];

        foreach ($items as $item) {
            ExpenseType::create(['name' => $item]);
        }
    }
}
