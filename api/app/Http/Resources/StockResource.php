<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StockResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'units' => $this->units,
            'unit_type' => $this->unit_type,
            'servings_per_unit' => $this->servings_per_unit,
            'cost_per_unit' => $this->cost_per_unit,

            // available
            // todo: implement units in singular/plural
        ];
    }
}
