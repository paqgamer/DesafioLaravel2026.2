<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
{
    return [
        'name' => fake()->words(3, true), 
        'description' => fake()->paragraph(),
        'price' => fake()->randomFloat(2, 50, 5000), 
        'stock_quantity' => fake()->numberBetween(1, 50),
        'image_url' => 'https://picsum.photos/400/400?random=' . fake()->unique()->numberBetween(1, 1000),
        
            //cria user e categoria se nao tiver especificado
        'category_id' => \App\Models\Category::factory(),
        'user_id' => \App\Models\User::factory(),
    ];
}
}
