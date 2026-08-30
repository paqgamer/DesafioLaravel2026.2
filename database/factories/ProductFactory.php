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
            'products/fone.jpg',
            'products/monitor.webp',
            'products/mouse.jpg',
            'products/teclado.jpg',
            'products/computador.jpg',
            // assim fica certo o lugar das imagens

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
            // tentativa numero  #21231231230 de criar o  grafico de produtos, agora  espalhando as datas do seeder
            'created_at' => fake()->dateTimeBetween('-11 months', 'now'),
        ];
    }
}
