<?php

use App\Models\Order;
use App\Models\Recipe;

test('planning endpoint returns orders and requirements', function () {
    $recipe = Recipe::factory()->create();
    Order::factory()->create(['recipe_id' => $recipe->id, 'status' => 'pending']);

    $response = $this->getJson('/api/planning');

    $response->assertStatus(200)
        ->assertJsonStructure([
            'orders',
            'planning' => [
                'ingredients_needed',
                'shopping_list',
                'estimated_total_time_minutes',
            ]
        ]);
});
