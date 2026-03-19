<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Ingredients
        $meat = Ingredient::factory()->create(['name' => 'Carne Moída', 'unit' => 'kg', 'current_stock' => 10, 'minimum_stock' => 5]);
        $pasta = Ingredient::factory()->create(['name' => 'Massa de Lasanha', 'unit' => 'kg', 'current_stock' => 5, 'minimum_stock' => 2]);
        $cheese = Ingredient::factory()->create(['name' => 'Queijo Muçarela', 'unit' => 'kg', 'current_stock' => 8, 'minimum_stock' => 3]);
        $rice = Ingredient::factory()->create(['name' => 'Arroz Arbóreo', 'unit' => 'kg', 'current_stock' => 10, 'minimum_stock' => 5]);
        $lettuce = Ingredient::factory()->create(['name' => 'Alface', 'unit' => 'unidade', 'current_stock' => 20, 'minimum_stock' => 10]);
        $tomato = Ingredient::factory()->create(['name' => 'Tomate', 'unit' => 'kg', 'current_stock' => 15, 'minimum_stock' => 5]);
        $chicken = Ingredient::factory()->create(['name' => 'Peito de Frango', 'unit' => 'kg', 'current_stock' => 12, 'minimum_stock' => 4]);

        // Recipes
        $lasagna = Recipe::factory()->create(['name' => 'Lasanha à Bolonhesa', 'prep_time_minutes' => 45]);
        $lasagna->ingredients()->attach([
            $meat->id => ['quantity' => 0.5],
            $pasta->id => ['quantity' => 0.2],
            $cheese->id => ['quantity' => 0.3],
            $tomato->id => ['quantity' => 0.1],
        ]);

        $risotto = Recipe::factory()->create(['name' => 'Risoto de Cogumelos', 'prep_time_minutes' => 30]);
        $risotto->ingredients()->attach([
            $rice->id => ['quantity' => 0.15],
            $cheese->id => ['quantity' => 0.05],
        ]);

        $salad = Recipe::factory()->create(['name' => 'Salada Caesar', 'prep_time_minutes' => 15]);
        $salad->ingredients()->attach([
            $lettuce->id => ['quantity' => 1],
            $cheese->id => ['quantity' => 0.02],
        ]);

        $chickenRice = Recipe::factory()->create(['name' => 'Frango com Arroz', 'prep_time_minutes' => 35]);
        $chickenRice->ingredients()->attach([
            $chicken->id => ['quantity' => 0.3],
            $rice->id => ['quantity' => 0.1],
            $tomato->id => ['quantity' => 0.05],
        ]);

        // Active Orders
        Order::factory()->create(['recipe_id' => $lasagna->id, 'quantity' => 5, 'priority' => 5, 'status' => 'pending']);
        Order::factory()->create(['recipe_id' => $risotto->id, 'quantity' => 3, 'priority' => 3, 'status' => 'in_progress']);
        Order::factory()->create(['recipe_id' => $salad->id, 'quantity' => 2, 'priority' => 1, 'status' => 'pending']);
        Order::factory()->create(['recipe_id' => $chickenRice->id, 'quantity' => 4, 'priority' => 4, 'status' => 'pending']);

        // Completed Orders
        Order::factory()->count(10)->create(['status' => 'completed']);
        
        // Random Extra Recipes and Ingredients
        Ingredient::factory()->count(10)->create();
        Recipe::factory()->count(5)->create()->each(function ($recipe) {
             $recipe->ingredients()->attach(
                 Ingredient::inRandomOrder()->take(3)->pluck('id'),
                 ['quantity' => rand(1, 10) / 10]
             );
        });
    }
}
