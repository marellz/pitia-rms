<?php

namespace App\Service;

use App\Http\Requests\Serving\StoreServingRequest;
use App\Http\Requests\Serving\UpdateServingQuantitiesRequest;
use App\Http\Requests\Serving\UpdateServingRequest;
use App\Models\Serving\Serving;

class ServingService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        private readonly QuantityService $quantityService,
    )
    {
        //
    }

    public function all()
    {
        return Serving::all();
    }

    public function get(string $id)
    {
        $serving = Serving::findOrFail($id);
        return $serving;
    }

    public function store(StoreServingRequest $request)
    {
        $serving = Serving::create($request->safe()->only([
            // todo: implement DTO
            "name",
            "stock_id",
            "supplies_id",
            "description",
            "units",
            "unit_type",
        ]));

        return $serving;
    }

    public function update(string $id, UpdateServingRequest $request)
    {
        $serving = $this->get($id);
        $updated = $serving->update($request->safe()->only([
            // todo: implement DTO
            "name",
            "stock_id",
            "supplies_id",
            "description",
        ]));

        return $updated;
    }


    public function updateQuantities(string $id, UpdateServingQuantitiesRequest $request)
    {
        //
        $serving = $this->get($id);
        $valid =  $request->safe()->collect();
        // todo: export to another service
        if ($valid->has('type') && $valid->has('units')) {
           $update['units'] = $this->quantityService->updateUnits($valid, $serving->units);
        }

        $updated = $serving->update($update);

        return $updated;
    }

    public function delete(string $id)
    {
        $serving = $this->get($id);
        $deleted = $serving->delete();
        // todo: delete affiliated models
        return $deleted;
    }
}
