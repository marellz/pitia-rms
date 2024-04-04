<?php

declare(strict_types=1);

namespace App\Service;

use App\Http\Requests\Expenses\StoreExpensesRequest;
use App\Http\Requests\Expenses\StoreExpenseTypeRequest;
use App\Http\Requests\Expenses\UpdateExpensesRequest;
use App\Http\Requests\Expenses\UpdateExpenseTypeRequest;
use App\Models\Expenses\ExpenseType;

class ExpensesService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function all()
    {
    }

    public function get(string $id)
    {
    }

    public function store(StoreExpensesRequest $request)
    {
    }

    public function update(string $id, UpdateExpensesRequest $request)
    {
    }


    /**
     * 
     * EXPENSE TYPES
     * 
     */

    public function getTypes()
    {
        $items = ExpenseType::all();
        return $items;
    }

    public function getType(string $id)
    {
        $item = ExpenseType::findOrFail($id);
        return $item;
    }


    public function newType(StoreExpenseTypeRequest $request)
    {
        $item = ExpenseType::create($request->safe()->only([
            // todo: implement DTO
            'name',
            'description'
        ]));
        
        return $item;
    }
    
    public function updateType(string $id, UpdateExpenseTypeRequest $request)
    {
        $item = $this->getType($id);
        $updated = $item->update($request->safe()->only([
            // todo: implement DTO
            'name',
            'description'
        ]));

        return $updated;
    }

    public function deleteType(string $id)
    {
        $item = $this->getType($id);
        $deleted = $item->delete();

        return $deleted;
    }
}
