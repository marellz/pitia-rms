<?php

declare(strict_types=1);

namespace App\Http\Resources\Sale;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SaleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        $date = new Carbon($this->created_at);
        
        $day = $date->toDateString();
        $time = $date->format('h:iA');
        if ($date->isToday()) {
            $day = 'Today';
        }

        $formattedDate =$day.' - '.$time;

        return [
            "id" => $this->id,
            "number" => $this->order_number,
            "complete" => !!$this->complete,
            "created" => $formattedDate,
            "status" => $this->status,
            "amount" => $this->amount,
            "created_by" => [
                'id' => $this->creator->id,
                'name' => $this->creator->name,
            ],
            "items" => SaleItemResource::collection($this->items),
        ];
    }
}
