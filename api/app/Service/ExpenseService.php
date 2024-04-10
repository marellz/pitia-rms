<?php

declare(strict_types=1);

namespace App\Service;

use App\Http\Requests\Expense\StoreExpenseRequest;
use App\Http\Requests\Expense\StoreExpenseTypeRequest;
use App\Http\Requests\Expense\UpdateExpenseRequest;
use App\Http\Requests\Expense\UpdateExpenseTypeRequest;
use App\Http\Resources\ExpenseResource;
use App\Models\Expense\Expense;
use App\Models\Expense\ExpenseType;

class ExpenseService
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
        $items = Expense::all();
        return ExpenseResource::collection($items);
    }

    public function get(string $id)
    {
        $item = Expense::findOrFail($id);
        return new ExpenseResource($item);
    }

    public function store(StoreExpenseRequest $request)
    {
        $item = Expense::create($request->safe()->only([
            // todo: implement DTO
            "amount",
            "expense_type_id",
            "extra_details",
            "created_by",
            "settled",
        ]));

        return new ExpenseResource($item);
    }

    public function update(string $id, UpdateExpenseRequest $request)
    {
        $item = $this->get($id);
        $updated = $item->update($request->safe()->only([
            // todo: implement DTO
            "amount",
            "expense_type_id",
            "extra_details",
            "settled",

        ]));

        return $updated;
    }

    public function updateSettled(string $id)
    {
        $item = $this->get($id);
        $updated = $item->update([
            'settled' => true,
        ]);

        return $updated;
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
