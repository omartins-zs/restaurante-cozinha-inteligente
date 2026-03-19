<?php

use App\Models\Order;
use App\Models\Recipe;

test('it can list orders', function () {
    Order::factory()->count(3)->create();

    $this->getJson('/api/orders')
        ->assertStatus(200)
        ->assertJsonCount(3);
});

test('it can create an order', function () {
    $recipe = Recipe::factory()->create();

    $this->postJson('/api/orders', [
        'recipe_id' => $recipe->id,
        'quantity' => 2,
        'priority' => 3,
    ])->assertStatus(201);

    $this->assertDatabaseHas('orders', ['quantity' => 2]);
});

test('it can update an order and subtract stock when completed', function () {
    $ingredient = \App\Models\Ingredient::factory()->create(['current_stock' => 10]);
    $recipe = Recipe::factory()->create();
    $recipe->ingredients()->attach($ingredient->id, ['quantity' => 2]);
    $order = Order::factory()->create(['recipe_id' => $recipe->id, 'quantity' => 3, 'status' => 'pending']);

    $this->putJson("/api/orders/{$order->id}", [
        'status' => 'completed',
    ])->assertStatus(200);

    $this->assertEquals('completed', $order->fresh()->status);
    $this->assertEquals(4, $ingredient->fresh()->current_stock); // 10 - (2 * 3)
});
