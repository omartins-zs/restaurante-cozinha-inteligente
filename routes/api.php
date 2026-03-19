<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\InventoryController;
use App\Http\Controllers\Api\PlanningController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('orders', OrderController::class);
Route::get('inventory', [InventoryController::class, 'index']);
Route::put('inventory/{ingredient}', [InventoryController::class, 'update']);
Route::get('planning', [PlanningController::class, 'index']);
Route::get('recipes', function() {
    return \App\Models\Recipe::with('ingredients')->get();
});
