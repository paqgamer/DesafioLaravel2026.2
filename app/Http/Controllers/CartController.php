<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // issoaqui é  pika
    private function getOrCreateCart(Request $request): Order
    {
        return Order::firstOrCreate(
            ['user_id' => $request->user()->id, 'status' => 'carrinho'],
            ['total_amount' => 0]
        );
    }

    public function index(Request $request)
    {
        $carrinho = $this->getOrCreateCart($request)->load('items.product');

        return view('cart.index', ['carrinho' => $carrinho]);
    }
// eu  to pensando em forma de colocar mais if else, por que não??
    public function add(Request $request, Product $product)
    {
        $quantidade = max(1, (int) $request->input('quantity', 1));

        if ($quantidade > $product->stock_quantity) {
            return back()->with('error', 'Quantidade solicitada indisponível em estoque.');
        }

        $carrinho = $this->getOrCreateCart($request);
        $item = $carrinho->items()->where('product_id', $product->id)->first();

        if ($item) {
            $novaQuantidade = $item->quantity + $quantidade;

            if ($novaQuantidade > $product->stock_quantity) {
                return back()->with('error', 'Não há tantas unidades em estoque.');
            }

            $item->update(['quantity' => $novaQuantidade]);
        } else {
            $carrinho->items()->create([
                'product_id' => $product->id,
                'quantity' => $quantidade,
                'unit_price' => $product->price, 
            ]);
        }

        $this->recalcularTotal($carrinho);

        return back()->with('success', 'Produto adicionado ao carrinho!');
    }

    public function updateQuantity(Request $request, OrderItem $item)
    {
        $this->autorizarItem($request, $item);

        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validated['quantity'] > $item->product->stock_quantity) {
            return back()->with('error', 'Não há tantas unidades em estoque.');
        }

        $item->update(['quantity' => $validated['quantity']]);

        $this->recalcularTotal($item->order);

        return back()->with('success', 'Carrinho atualizado.');
    }

    public function remove(Request $request, OrderItem $item)
    {
        $this->autorizarItem($request, $item);

        $carrinho = $item->order;
        $item->delete();

        $this->recalcularTotal($carrinho);

        return back()->with('success', 'Item removido do carrinho.');
    }

  
    private function autorizarItem(Request $request, OrderItem $item): void
    {
        // viva a segurança da informação, que infelizmente não funciona aqui, mas enfim... 
        abort_if(
            $item->order->user_id !== $request->user()->id || $item->order->status !== 'carrinho',
            403,
            'Você não tem permissão para alterar este item.'
        );
    }
    // não tem  outro jeito de fazer isso, impossível
    private function recalcularTotal(Order $carrinho): void
    {
        $total = $carrinho->items()->get()->sum(
            fn ($item) => $item->quantity * $item->unit_price
        );

        $carrinho->update(['total_amount' => $total]);
    }
}