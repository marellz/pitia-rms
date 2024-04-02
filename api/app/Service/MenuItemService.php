<?php

declare(strict_types=1);

namespace App\Service;

use App\Http\Requests\MenuItem\StoreMenuItemRequest;
use App\Http\Requests\MenuItem\UpdateMenuItemRequest;
use App\Http\Resources\MenuItemCategoryResource;
use App\Http\Resources\MenuItemResource;
use App\Models\Menu\MenuItem;
use App\Models\Menu\MenuItemCategory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Collection as SupportCollection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class MenuItemService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        private readonly MenuItemCategory $menuItemCategory
    ) {
        //   
    }

    public function all($params): Collection | SupportCollection | AnonymousResourceCollection
    {
        $items = MenuItem::get();
        if ($params['show_by'] === 'categories') {
            $categories = $this->menuItemCategory->oldest()->get();
            $items = MenuItemCategoryResource::collection($categories);
            $items = collect($items)->prepend([
                'name' => 'All',
                'items' => MenuItemResource::collection(MenuItem::all()),
            ]);
        } else {
            $items = MenuItemResource::collection($items);
        }

        return $items;
    }

    public function get(string $id): MenuItemResource
    {
        $menuItem = MenuItem::findOrFail($id);

        if(!$menuItem->exists){
            throw new NotFoundHttpException('Not found');
        }

        return new MenuItemResource($menuItem);
    }

    public function store(StoreMenuItemRequest $request): MenuItemResource
    {
        $validated = $request->safe()->only([
            // todo: implement DTO
            'name',
            'menu_item_category_id',
            'price',
            'sale_price',
            'image',
            'description',
        ]);

        $menuItem = MenuItem::create($validated);
        
        return new MenuItemResource($menuItem);
    }
    
    public function update(UpdateMenuItemRequest $request, string $id): MenuItemResource
    {
        $menuItem = $this->get($id);
        $menuItem->update($request->safe()->only([
            // todo: implement DTO
            'name',
            'menu_item_category_id',
            'price',
            'sale_price',
            'image',
            'description',
        ]));

        return new MenuItemResource($menuItem);
    }

    public function delete(string $id): array
    {
        $menuItem = $this->get($id);
        
        foreach ($menuItem->servings as $serving) {
            $serving->delete();
        }

        $deleted = $menuItem->delete();

        return ['deleted' => $deleted];
    }
}
