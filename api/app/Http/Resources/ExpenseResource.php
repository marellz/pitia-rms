<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExpenseResource extends JsonResource
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
            "amount" => $this->amount,
            "expense_type" => [
                "id" =>  $this->type->id,
                "name" => $this->type->name,
            ],
            "extra_details" => $this->extra_details,
            "created_by" =>
            [
                "id" => $this->creator->id,
                "name" => $this->creator->name,
            ],
            "settled" => $this->settled > 0,
        ];
    }
}
