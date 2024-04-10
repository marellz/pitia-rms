<?php

namespace App\Http\Controllers;

use App\Http\Requests\Expense\StoreExpenseTypeRequest;
use App\Http\Requests\Expense\UpdateExpenseTypeRequest;
use App\Service\ExpenseService;

class ExpenseTypeController extends Controller
{
    //

    public function __construct(
        private readonly ExpenseService $service
    )
    {
        //    
    }


    public function index()
    {
        $data['items'] = $this->service->getTypes();
        return $this->respond($data);
    }

    public function show(string $id)
    {
        $data['item'] = $this->service->getType($id);
        return $this->respond($data);
    }

    public function store(StoreExpenseTypeRequest $request)
    {
        $data['item'] = $this->service->newType($request);
        return $this->respond($data);
    }

    public function update(string $id, UpdateExpenseTypeRequest $request)
    {
        $data['updated'] = $this->service->updateType($id, $request);
        return $this->respond($data);
    }

    public function destroy(string $id)
    {
        $data['deleted'] = $this->service->deleteType($id);
        return $this->respond($data);
    }
}
