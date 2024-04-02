<?php

namespace App\Service;

use App\Http\Requests\Supplies\StoreSuppliesRequest;
use App\Http\Requests\Supplies\UpdateSuppliesQuantitiesRequest;
use App\Http\Requests\Supplies\UpdateSuppliesRequest;
use App\Http\Resources\SuppliesResource;
use App\Models\Stock\Supplies;
use Exception;

class SuppliesService
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
        $supplies = Supplies::all();
        return SuppliesResource::collection($supplies);
    }

    public function get(string $id)
    {
        $item = Supplies::findOrFail($id);
        return new SuppliesResource($item);
    }

    public function store(StoreSuppliesRequest $request)
    {
        $item = Supplies::create($request->safe()->only([
            // todo: implement DTO
            "name",
            "description",
            "units",
            "servings_per_unit",
            "cost_per_unit",
        ]));

        return new SuppliesResource($item);
    }

    public function update(string $id, UpdateSuppliesRequest $request)
    {
        $item = $this->get($id);
        $updated = $item->update($request->safe()->only([
            "name",
            "description",
        ]));

        return $updated;
    }

    public function updateQuantities(string $id, UpdateSuppliesQuantitiesRequest $request)
    {
        $item = $this->get($id);
        $update = [];
        $valid = $request->safe()->collect();
        if ($valid->has('units') && $request->has('type')) {
            $units = 0;
            $type = $valid->get('type');
            $diff = $valid->get('units');
            if ($type === 'addition') {
                $units = $item->units + $diff;
            } else if ($type === 'deduction') {
                if ($item->units < $diff) {
                    throw new Exception("Units available are too few");
                }

                $units = $item->units - $diff;
            }

            $update['units'] = $units;
            
        }
        
        if ($valid->has('servings_per_unit')) {
            $update['servings_per_unit'] = $valid->get('servings_per_unit');
        }

        if ($valid->has('cost_per_unit')) {
            $update['cost_per_unit'] = $valid->get('cost_per_unit');
        }

        $updated = $item->update($update);

        return $updated;
    }

    public function delete(string $id)
    {
        $item = $this->get($id);

        // todo: delete all affiliated objects
        $deleted = $item->delete();

        return $deleted;
    }
}
