<?php

namespace App\Service;

use App\Http\Resources\MenuItemCategoryResource;
use App\Models\Menu\MenuItemCategory;

class MenuItemCategoryService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function all()
    {
        return MenuItemCategoryResource::collection(MenuItemCategory::all());
    }

    public function get(string $id)
    {
        $category = MenuItemCategory::findOrFail($id);
        return new MenuItemCategoryResource($category);
    }
}
