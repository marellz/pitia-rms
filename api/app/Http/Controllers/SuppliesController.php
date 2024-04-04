<?php

namespace App\Http\Controllers;

use App\Http\Requests\Supplies\StoreSuppliesRequest;
use App\Http\Requests\Supplies\UpdateSuppliesQuantitiesRequest;
use App\Http\Requests\Supplies\UpdateSuppliesRequest;
use App\Models\Stock\Supplies;
use App\Service\SuppliesService;

class SuppliesController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct (
        private readonly SuppliesService $service,
    )
    {
        
    }
    public function index()
    {
        //
        $data['items'] = $this->service->all();
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
    public function store(StoreSuppliesRequest $request)
    {
        //
        $data['item'] = $this->service->store($request);
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
    public function update(UpdateSuppliesRequest $request, string $id)
    {
        //
        $data['updated'] = $this->service->update($id, $request);
        return $this->respond($data);
    }

    public function updateQuantities(UpdateSuppliesQuantitiesRequest $request, string $id)
    {
        $data['updated'] = $this->service->updateQuantities($id, $request);
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
