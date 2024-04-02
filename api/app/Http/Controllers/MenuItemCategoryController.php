<?php

namespace App\Http\Controllers;

use App\Models\Menu\MenuItemCategory;
use App\Service\MenuItemCategoryService;
use Illuminate\Http\Request;

class MenuItemCategoryController extends Controller
{
    //

    public function __construct(
        private readonly MenuItemCategoryService $service,
    ) {
    }
    public function index()
    {
        $data = $this->service->all();
        return $this->respond($data);
    }

    public function show(string $id)
    {
        $data = $this->service->get($id);
        return $this->respond($data);
    }
}
