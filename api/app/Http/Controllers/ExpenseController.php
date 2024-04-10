<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Expense\StoreExpenseRequest;
use App\Http\Requests\Expense\UpdateExpenseRequest;
use App\Service\ExpenseService;

class ExpenseController extends Controller
{
    public function __construct(
        private readonly ExpenseService $service
    )
    {
        //
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data['items'] = $this->service->all();
        return $this->respond($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExpenseRequest $request)
    {
        // todo: all $data['**'] should be items/item/updated/deleted
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
    public function update(UpdateExpenseRequest $request, string $id)
    {
        //
        $data['updated'] = $this->service->update($id, $request);
        return $this->respond($data);
    }

    public function updateSettled(string $id)
    {
        //
        $data['updated'] = $this->service->updateSettled($id);
        return $this->respond($data);
    }

}