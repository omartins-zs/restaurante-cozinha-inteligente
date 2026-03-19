<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\ProductionService;
use Illuminate\Http\Request;

class PlanningController extends Controller
{
    protected $productionService;

    public function __construct(ProductionService $productionService)
    {
        $this->productionService = $productionService;
    }

    public function index()
    {
        $orders = Order::with('recipe.ingredients')
            ->where('status', '!=', 'completed')
            ->orderBy('priority', 'desc')
            ->get();

        $ingredientsNeeded = $this->productionService->calculateIngredientsNeeded($orders);
        $shoppingList = $this->productionService->generateShoppingList($ingredientsNeeded);
        $totalTime = $this->productionService->estimateProductionTime($orders);

        return response()->json([
            'orders' => $orders,
            'planning' => [
                'ingredients_needed' => $ingredientsNeeded,
                'shopping_list' => $shoppingList,
                'estimated_total_time_minutes' => $totalTime,
            ],
        ]);
    }
}
