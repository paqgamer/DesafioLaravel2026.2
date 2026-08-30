<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600;14..32,700&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <title>Meu Carrinho | De$af.io</title>
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
        <link rel="icon" type="image/x-icon" href="{{ asset('image/favicon.svg') }}">

    <link rel="stylesheet" href="{{ asset('css/admproducts.css') }}">
</head>

<body>

    <x-navbar :categorias="[]" />

    <main class="admin-container">

        <div class="admin-header">
            <div>
                <h1>Meu Carrinho</h1>
                <p>Revise os itens antes de finalizar a compra.</p>
            </div>
        </div>

        @if (session('success'))
            <div class="alert-success">
                <span class="material-symbols-outlined">check_circle</span>
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert-error">
                <span class="material-symbols-outlined">error</span>
                {{ session('error') }}
            </div>
        @endif

        <div class="table-card">
            <table class="products-table">
                <thead>
                    <tr>
                        <th>Imagem</th>
                        <th>Produto</th>
                        <th>Preço Unit.</th>
                        <th>Quantidade</th>
                        <th>Subtotal</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($carrinho->items as $item)
                        <tr>
                            <td>
                                <img src="{{ asset('storage/' . $item->product->image_url) }}"
                                    alt="{{ $item->product->name }}" class="product-thumb">
                            </td>
                            <td class="font-bold">{{ $item->product->name }}</td>
                            <td>{{ format_price($item->unit_price) }}</td>
                            <td>
                                <form action="{{ route('cart.update', $item->id) }}" method="POST"
                                    class="inline-form">
                                    @csrf
                                    @method('PATCH')
                                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1"
                                        max="{{ $item->product->stock_quantity }}" style="width: 60px;"
                                        onchange="this.form.submit()">
                                </form>
                            </td>
                            <td>{{ format_price($item->quantity * $item->unit_price) }}</td>
                            <td class="actions-cell">
                                <form action="{{ route('cart.remove', $item->id) }}" method="POST"
                                    class="inline-form"
                                    onsubmit="return confirm('Remover este item do carrinho?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete" title="Remover">
                                        <span class="material-symbols-outlined">delete</span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="empty-state">
                                Seu carrinho está vazio. <a href="{{ route('home') }}">Ver produtos</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($carrinho->items->isNotEmpty())
            <form action="{{ route('checkout.redirect') }}" method="POST" class="form-card"
                style="margin-top: 16px; display: flex; justify-content: space-between; align-items: center;">
                @csrf
                <strong style="font-size: 1.1rem;">Total: {{ format_price($carrinho->total_amount) }}</strong>
                <button type="submit" class="btn-save">Finalizar Compra</button>
            </form>
        @endif

    </main>
</body>
<x-footer />
</html>