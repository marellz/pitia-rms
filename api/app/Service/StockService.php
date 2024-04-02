<?php

namespace App\Service;

use App\Http\Requests\Stock\StoreStockRequest;
use App\Http\Requests\Stock\UpdateStockRequest;
use App\Http\Requests\Supplies\UpdateStockQuantitiesRequest;
use App\Http\Resources\StockResource;
use App\Models\Stock\Stock;
use Illuminate\Http\Request;

class StockService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        private readonly QuantityService $quantityService
    )
    {
        //
    }

    public function all(Request $params)
    {
        $items = Stock::all();
        return StockResource::collection($items);
    }

    public function get(string $id)
    {
        $stock = Stock::findOrFail($id);
        return new StockResource($stock);
    }

    public function store(StoreStockRequest $request)
    {
        $stock = Stock::create($request->safe()->only([
            // todo: implement DTO
            'name',
            'description',
            'units',
            'unit_type',
            'servings_per_unit',
            'cost_per_unit'
        ]));

        return new StockResource($stock);
    }

    public function update(string $id, UpdateStockRequest $request)
    {
        $stock = $this->get($id);
        $stock->update($request->safe()->only([
            // todo: implement DTO
            'name',
            'description',
            'unit_type',
            'servings_per_unit',
            'cost_per_unit'
        ]));

        return new StockResource($stock);
    }

    public function updateQuantities(string $id, UpdateStockQuantitiesRequest $request) : bool
    {
        $stock = $this->get($id);
        $update = [];
        $valid = $request->safe()->collect();
        
        if ($valid->has('type') && $valid->has('units')) {
            $update['units'] = $this->quantityService->updateUnits($valid, $stock->units);
        }

        if($valid->has('cost_per_unit')){
            $update['cost_per_unit'] = $valid->get('cost_per_unit');
        }

        if($valid->has('servings_per_unit')){
            $update['servings_per_unit'] = $valid->get('servings_per_unit');
        }

        $updated = $stock->update($update);

        return $updated;
    }


    /**
     * 
     * DESTROY
     * 
     */

    public function delete(string $id)
    {
        $stock = $this->get($id);

        // todo: delete all afilliated models

        $deleted = $stock->delete();

        return $deleted;
    }
}
