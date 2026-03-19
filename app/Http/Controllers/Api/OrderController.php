<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return Order::with('recipe')->orderBy('created_at', 'desc')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'recipe_id' => 'required|exists:recipes,id',
            'quantity' => 'required|integer|min:1',
            'priority' => 'integer|min:1|max:5',
        ]);

        $order = Order::create($validated);

        return response()->json($order, 201);
    }

    public function update(Request $request, Order $order)
    {
        $oldStatus = $order->status;
        $order->update($request->only(['status', 'priority', 'quantity']));

        if ($order->status === 'completed' && $oldStatus !== 'completed') {
            $order->recipe->ingredients->each(function ($ingredient) use ($order) {
                $qtyToSubtract = $ingredient->pivot->quantity * $order->quantity;
                $ingredient->decrement('current_stock', $qtyToSubtract);
            });
        }

        return response()->json($order->load('recipe.ingredients'));
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return response()->json(null, 204);
    }
}
