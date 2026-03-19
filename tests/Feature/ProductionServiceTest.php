<?php

use App\Models\Ingredient;
use App\Models\Order;
use App\Models\Recipe;
use App\Services\ProductionService;

beforeEach(fn () => $this->service = new ProductionService());

test('it calculates ingredients needed correctly', function () {
    $ingredient = Ingredient::factory()->create(['name' => 'Tomato', 'current_stock' => 10]);
    $recipe = Recipe::factory()->create();
    $recipe->ingredients()->attach($ingredient->id, ['quantity' => 2]);
    $order = Order::factory()->create(['recipe_id' => $recipe->id, 'quantity' => 3]);

    $needs = $this->service->calculateIngredientsNeeded(collect([$order]));

    expect($needs)->toHaveCount(1)
        ->and($needs->first()['quantity'])->toBe(6);
});

test('it generates shopping list for missing items', function () {
    $needs = collect([
        [
            'id' => 1,
            'name' => 'Cheese',
            'unit' => 'kg',
            'quantity' => 10,
            'current_stock' => 4,
        ]
    ]);

    $shoppingList = $this->service->generateShoppingList($needs);

    expect($shoppingList)->toHaveCount(1)
        ->and($shoppingList->first()['to_buy'])->toBe(6);
});

test('it calculates complex production needs', function () {
    $flour = Ingredient::factory()->create(['name' => 'Flour', 'current_stock' => 5]);
    $water = Ingredient::factory()->create(['name' => 'Water', 'current_stock' => 100]);

    $recipe1 = Recipe::factory()->create(['name' => 'Bread']);
    $recipe1->ingredients()->attach($flour->id, ['quantity' => 1]);
    $recipe1->ingredients()->attach($water->id, ['quantity' => 0.5]);

    $recipe2 = Recipe::factory()->create(['name' => 'Cake']);
    $recipe2->ingredients()->attach($flour->id, ['quantity' => 0.5]);

    $order1 = Order::factory()->create(['recipe_id' => $recipe1->id, 'quantity' => 10]);
    $order2 = Order::factory()->create(['recipe_id' => $recipe2->id, 'quantity' => 4]);

    $needs = $this->service->calculateIngredientsNeeded(collect([$order1, $order2]));
    $flourNeed = collect($needs)->firstWhere('name', 'Flour');

    expect($flourNeed['quantity'])->toBe(12.0);
});
