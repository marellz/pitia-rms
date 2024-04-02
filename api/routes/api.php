<?php

use App\Http\Controllers\MenuItemCategoryController;
use App\Http\Controllers\MenuItemController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('menu', MenuItemController::class);
Route::group(['prefix' => 'menu-categories'], function () {
    Route::get('/', [MenuItemCategoryController::class, 'index']);
    Route::get('/{id}', [MenuItemCategoryController::class, 'show']);
});
