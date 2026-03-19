<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use App\Models\Order;
use App\Models\Recipe;
use Illuminate\Database\Seeder;

class LowStockScenarioSeeder extends Seeder
{
    public function run(): void
    {
        // Low stock: Flour
        $flour = Ingredient::factory()->create([
            'name' => 'Farinha de Trigo',
            'current_stock' => 2, // Only 2kg
            'unit' => 'kg'
        ]);

        $bread = Recipe::factory()->create(['name' => 'Pão Caseiro']);
        $bread->ingredients()->attach($flour->id, ['quantity' => 1]); // Needs 1kg per order

        // Create 5 orders of bread -> Needs 5kg. Stock is 2kg. 3kg missing.
        Order::factory()->count(5)->create([
            'recipe_id' => $bread->id,
            'quantity' => 1,
            'status' => 'pending'
        ]);
    }
}
