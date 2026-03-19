<?php

use App\Models\Ingredient;

test('it can list inventory items', function () {
    Ingredient::factory()->count(5)->create();

    $this->getJson('/api/inventory')
        ->assertStatus(200)
        ->assertJsonCount(5);
});

test('it can update stock levels', function () {
    $ingredient = Ingredient::factory()->create(['current_stock' => 10]);

    $this->putJson("/api/inventory/{$ingredient->id}", [
        'current_stock' => 25,
        'minimum_stock' => 5,
    ])->assertStatus(200);

    $this->assertEquals(25, $ingredient->fresh()->current_stock);
    $this->assertEquals(5, $ingredient->fresh()->minimum_stock);
});
