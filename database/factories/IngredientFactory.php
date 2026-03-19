<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ingredient>
 */
class IngredientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Ingrediente ' . rand(1, 1000),
            'unit' => 'kg',
            'current_stock' => rand(5, 50),
            'minimum_stock' => rand(2, 10),
        ];
    }
}
