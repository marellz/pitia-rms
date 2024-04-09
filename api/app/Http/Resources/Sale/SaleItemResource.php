<?php
declare(strict_types=1);

namespace App\Http\Resources\Sale;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SaleItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        $menuItem = $this->menuItem;
        return [
            'id' => $this->id,
            'menu_item_id' => $menuItem->id,
            'name' => $menuItem->name,
            'price' => $this->price,
        ];
    }
}
