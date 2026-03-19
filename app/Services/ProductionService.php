<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Ingredient;
use Illuminate\Support\Collection;

class ProductionService
{
    /**
     * Calculate total ingredients needed for given orders.
     */
    public function calculateIngredientsNeeded(Collection $orders): Collection
    {
        $needs = collect();

        foreach ($orders as $order) {
            $recipe = $order->recipe;
            foreach ($recipe->ingredients as $ingredient) {
                $qtyNeeded = $ingredient->pivot->quantity * $order->quantity;
                
                if ($needs->has($ingredient->id)) {
                    $item = $needs->get($ingredient->id);
                    $item['quantity'] += $qtyNeeded;
                    $needs->put($ingredient->id, $item);
                } else {
                    $needs->put($ingredient->id, [
                        'id' => $ingredient->id,
                        'name' => $ingredient->name,
                        'unit' => $ingredient->unit,
                        'quantity' => $qtyNeeded,
                        'current_stock' => $ingredient->current_stock,
                    ]);
                }
            }
        }

        return $needs->values();
    }

    /**
     * Generate a shopping list based on missing ingredients.
     */
    public function generateShoppingList(Collection $ingredientNeeds): Collection
    {
        return $ingredientNeeds->map(function ($item) {
            $missing = $item['quantity'] - $item['current_stock'];
            return [
                'id' => $item['id'],
                'name' => $item['name'],
                'unit' => $item['unit'],
                'needed' => $item['quantity'],
                'stock' => $item['current_stock'],
                'to_buy' => max(0, $missing),
            ];
        })->filter(fn($item) => $item['to_buy'] > 0)->values();
    }

    /**
     * Estimate total production time.
     * For simplicity, let's assume some parallelization or simple sum.
     */
    public function estimateProductionTime(Collection $orders): int
    {
        // Simple heuristic: sum of all prep times
        // A more complex one would account for shared tasks
        return $orders->sum(fn($order) => $order->recipe->prep_time_minutes * $order->quantity);
    }
}
