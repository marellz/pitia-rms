<?php

declare(strict_types=1);

namespace App\Service;

use App\Http\Requests\Sale\StoreSalesRequest;
use App\Http\Requests\Sale\UpdateSalesRequest;
use App\Http\Resources\Sale\SaleResource;
use App\Models\Sale\Sale;
use App\Models\Sale\SaleMenuItem;
use Illuminate\Http\Request;

class SaleService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function all(Request $request)
    {
        $sales = Sale::all();
        
        if ($request->has('complete') && $request->get('complete')==="0") {
            $sales = Sale::where('complete', false)->get();
        }

        return SaleResource::collection($sales);
    }

    public function get(string $id)
    {
        $sale = Sale::findOrFail($id);
        return new SaleResource($sale);
    }

    public function addItems(string $id, $items)
    {
        // todo: custom validator?

        foreach ($items as $item) {
            $item = SaleMenuItem::create([
                'menu_item_id' => $item['id'],
                'price' => $item['price'],
                'sale_id' => $id,
            ]);
        }
    }

    public function store(StoreSalesRequest $request)
    {
        $sale = Sale::create($request->safe()->only([
            // todo: implement DTO'
            'created_by',
            'amount',
            'status',
        ]));

        $this->addItems($sale->id, $request->items);

        return new SaleResource($sale->fresh());
    }

    public function update(string $id, UpdateSalesRequest $request)
    {
        $sale = $this->get($id);
        $updated = $sale->update($request->safe()->only([
            // todo: implement DTO
            'amount',
            'status',
        ]));

        if ($request->items) {
            $this->addItems($sale->id, $request->items);
        }

        return $updated;
    }
    
    public function markAsPaid(string $id)
    {
        $sale = $this->get($id);
        $paid = $sale->update(['status'=>'paid']);

        return $paid;
    }

    public function markAsComplete(string $id)
    {
        $sale = $this->get($id);
        $completed = $sale->update(['complete' => true, 'status'=> 'complete']);

        return $completed;
    }
}
