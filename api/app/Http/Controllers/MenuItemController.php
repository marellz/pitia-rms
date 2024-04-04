<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\MenuItem\StoreMenuItemRequest;
use App\Http\Requests\MenuItem\UpdateMenuItemRequest;
use App\Models\Menu\MenuItem;
use App\Service\MenuItemCategoryService;
use App\Service\MenuItemService;
use App\Service\ServingService;
use Illuminate\Http\Request;

class MenuItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct (
        private readonly MenuItemService $service,
        private readonly ServingService $servingsService,
        private readonly MenuItemCategoryService $categoryService
    )
    {
        
    }
    public function index(Request $request)
    {
        //
        $data = $this->service->all($request);
        return $this->respond($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $data['categories'] = $this->categoryService->all();
        $data['servings'] = $this->servingsService->all();
        return $this->respond($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMenuItemRequest $request)
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
        $data['servings'] = $this->servingsService->all();
        $data['item'] = $this->service->get($id);
        return $this->respond($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMenuItemRequest $request, string $id)
    {
        //
        $data = $this->service->update($request, $id);
        return $this->respond($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $data = $this->service->delete($id);
        return $this->respond($data);
    }
}
