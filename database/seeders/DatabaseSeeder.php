<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // mudei pra 50  candango,pra  testar melhot
        $users = User::factory(50)->create();

        // usuario admin pra testes, cansei de abrir o adminer toda hora
        // manter  isolado para nao ter produtos vendas etc
        User::factory()->create([
            'name' => 'admdosite',
            'email' => 'bagre@admin.com',
            'password' => bcrypt('123123'),
            'cpf' => '00000000001',
            'is_admin' => true,
        ]);

        // usuario  comumde teste, entrando no mesmo "grupo" dos outros aleatorios
        $usuarioComum = User::factory()->create([
            'name' => 'user',
            'email' => 'bagre@user.com',
            'password' => bcrypt('123123'),
            'cpf' => '00000000002',
            'is_admin' => false,
        ]);

        $users->push($usuarioComum);

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
        // agora 600
        Product::factory(600)
            ->recycle($users)
            ->recycle($categories)
            ->create();

        //eu devia ter poensado nisso antes pra gerar o relatorio
        $todosProdutos = Product::all();

        for ($i = 0; $i < 400; $i++) {
            $comprador = $users->random();

            //na minha cabeça faz sentido, comprar de si próprio é esquizo
            $produtosDisponiveis = $todosProdutos->where('user_id', '!=', $comprador->id);

            if ($produtosDisponiveis->isEmpty()) {
                continue;
            }

            $quantidadeItens = min(3, $produtosDisponiveis->count());
            $itensDoPedido = $produtosDisponiveis->random($quantidadeItens);

            // normalizar essa bagaça
            if ($quantidadeItens === 1) {
                $itensDoPedido = collect([$itensDoPedido]);
            }

            $pedido = Order::create([
                'user_id' => $comprador->id,
                'status' => 'pago',
                'paid_at' => fake()->dateTimeBetween('-11 months', 'now'),
                'total_amount' => 0,
            ]);

            $total = 0;

            foreach ($itensDoPedido as $produto) {
                $quantidade = fake()->numberBetween(1, 3);
                $total += $quantidade * $produto->price;

                $pedido->items()->create([
                    'product_id' => $produto->id,
                    'quantity' => $quantidade,
                    'unit_price' => $produto->price,
                ]);
            }

            $pedido->update(['total_amount' => $total]);
        }
    }
}