<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // dez candango pra fingir que tem gente que usar meu site
    $users = User::factory(10)->create();

        // Uma porrada de categorias, que no futuro tenho que revisar
        $categories = collect([
            'Computadores',
            'Notebooks',
            'Monitores',
            'Celulares',
            'Tablets',
            'Smartwatches',
            'Consoles',
            'Jogos',
            'Periféricos',
            'Teclados',
            'Mouses',
            'Headsets',
            'Áudio',
            'Câmeras',
            'Impressoras',
            'Armazenamento',
            'Componentes',
            'Redes',
            'Smart Home',
            'TVs',
            'Projetores',
            'Acessórios',
        ])->map(function ($nome) {
            return Category::create(['name' => $nome]);
        });

        // mudei agora de 30 pra 60 produto falso (ficticio, não é falsificado)
        Product::factory(60)
            ->recycle($users)
            ->recycle($categories)
            ->create();
    }
}
