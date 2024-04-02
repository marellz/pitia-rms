<?php

namespace App\Http\Controllers;

use App\Http\Requests\Stock\StoreStockRequest;
use App\Http\Requests\Stock\UpdateStockRequest;
use App\Http\Requests\Stock\UpdateStockCostRequest;
use App\Http\Requests\Stock\UpdateStockUnitsRequest;
use App\Models\Stock\Stock;
use App\Service\StockService;
use Illuminate\Http\Request;

class StockController extends Controller
{

    public function __construct(
        private readonly StockService $service,
    ) {
        //
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $data['items'] = $this->service->all($request);
        return $this->respond($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStockRequest $request)
    {
        //
        $data['stock'] = $this->service->store($request);
        return $this->respond($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $data['item'] = $this->service->get($id);
        return $this->respond($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStockRequest $request, string $id)
    {
        //
        $data['item'] = $this->service->update($id, $request);
        return $this->respond($data);
    }

    public function updateCost(UpdateStockCostRequest $request, string $id)
    {
        $data['updated'] = $this->service->updateCost($id, $request);
        return $this->respond($data);
    }

    public function updateUnits(UpdateStockUnitsRequest $request, string $id)
    {
        $data['updated'] = $this->service->updateUnits($id, $request);
        return $this->respond($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $data['deleted'] = $this->service->delete($id);
        return $this->respond($data);
    }
}
