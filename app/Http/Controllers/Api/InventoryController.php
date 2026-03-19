<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ingredient;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        return Ingredient::all();
    }

    public function update(Request $request, Ingredient $ingredient)
    {
        $ingredient->update($request->only(['current_stock', 'minimum_stock']));
        return response()->json($ingredient);
    }
}
