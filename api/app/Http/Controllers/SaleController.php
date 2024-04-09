<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Sale\StoreSalesRequest;
use App\Http\Requests\Sale\UpdateSalesRequest;
use App\Service\SaleService;
use Illuminate\Http\Request;

class SaleController extends Controller
{

    public function __construct(
        private readonly SaleService $service
    )
    {}

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
     * Store a newly created resource in storage.
     */
    public function store(StoreSalesRequest $request)
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
     * Update the specified resource in storage.
     */
    public function update(UpdateSalesRequest $request, string $id)
    {
        //
        $data['updated'] = $this->service->update($id, $request);
        return $this->respond($data);
    }

    public function updateComplete(string $id)
    {
        //
        $data['completed'] = $this->service->complete($id);
        return $this->respond($data);
    }
}
