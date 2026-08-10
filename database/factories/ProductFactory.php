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
    $randomimagensprodutos = [
            'image/produtos/fone.jpg',
            'image/produtos/monitor.webp',
            'image/produtos/mouse.jpg',
            'image/produtos/teclado.jpg',
            'image/produtos/computador.jpg',

            ];
    return [
        'name' => fake()->words(3, true), 
        'description' => fake()->paragraph(),
        'price' => fake()->randomFloat(2, 50, 5000), 
        'stock_quantity' => fake()->numberBetween(1, 50),
        // tirei o lorem picsum, agora fica imagens predefinidas
        'image_url' => fake()->randomElement($randomimagensprodutos),

            //cria user e categoria se nao tiver especificado
        'category_id' => \App\Models\Category::factory(),
        'user_id' => \App\Models\User::factory(),
    ];
}
}
