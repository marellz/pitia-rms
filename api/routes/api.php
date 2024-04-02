<?php

use App\Http\Controllers\MenuItemCategoryController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\StockController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});


Route::resources([
    'menu' => MenuItemController::class,
    'stock' => StockController::class,
]);

Route::group(['prefix' => 'menu-categories'], function () {
    Route::get('/', [MenuItemCategoryController::class, 'index']);
    Route::get('/{id}', [MenuItemCategoryController::class, 'show']);
});

Route::group(['prefix' => 'stock'], function () {
    Route::put('/{id}/update-units', [StockController::class, 'updateUnits']);
    Route::put('/{id}/update-cost', [StockController::class, 'updateCost']);
    
});