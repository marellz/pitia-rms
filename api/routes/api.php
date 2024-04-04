<?php

use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\MenuItemCategoryController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\ServingController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SuppliesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});


Route::resources([
    'menu' => MenuItemController::class,
    'stock' => StockController::class,
    'supplies' => SuppliesController::class,
    'servings' => ServingController::class,
    'expense-types' => ExpenseTypeController::class,
]);

Route::group(['prefix' => 'menu-categories'], function () {
    Route::get('/', [MenuItemCategoryController::class, 'index']);
    Route::get('/{id}', [MenuItemCategoryController::class, 'show']);
});

Route::group(['prefix' => 'stock'], function () {
    Route::put('/{id}/update-quantities', [StockController::class, 'updateQuantities']);
});

Route::group(['prefix' => 'supplies'], function () {
    Route::put('/{id}/update-quantities', [SuppliesController::class, 'updateQuantities']);
});

Route::group(['prefix' => 'servings'], function () {
    Route::put('/{id}/update-quantities', [ServingController::class, 'updateQuantities']);
});