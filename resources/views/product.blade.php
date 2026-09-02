<!DOCTYPE html>
<html lang="pt-BR">
<!-- tive que refazer essa bagaça, parcialmente -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600;14..32,700&display=swap"
        rel="stylesheet">
    <!-- O  link da fonte sempre vai errado -->
    <title>{{ $produto->name }} | De$af.io</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('image/favicon.svg') }}">

    <link rel="stylesheet" href="{{ asset('css/product.css') }}">
</head>

<body>
    <x-navbar :categorias="$categorias" />

    <main class="product-page-container">
        <a href="/" class="back-link">← Voltar aos produtos</a>

        <div class="product-details-card">

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

            <div class="product-top-section">

                <div class="product-image-container">

                    <!-- corrigir os caminhosda  imagem,  porque o asset{viadagem('frescura')} dá menos BO -->
                    <img src="{{ asset('storage/' . $produto->image_url) }}" alt="Foto de {{ $produto->name }}">
                </div>

                <div class="product-info-container">
                    <span class="category-badge">
                        {{ $produto->category->name ?? 'Sem Categoria' }}
                    </span>

                    <h1 class="product-title">{{ $produto->name }}</h1>

                    <div class="product-price-box">
                        {{ format_price($produto->price) }}
                    </div>
                    <!-- uma  coisa  linda, de  verdade -->
                    @if ($produto->stock_quantity > 0)
                        <form action="{{ route('cart.add', $produto->id) }}" method="POST" class="product-actions">
                            @csrf
                            <input type="number" name="quantity" value="1" min="1" max="{{ $produto->stock_quantity }}"
                                style="width: 60px;">
                            <button type="button" class="btn-buy-now" disabled
                                title="Tá quase, a  compravai funcinoar ainda">
                                Comprar Agora
                            </button>
                            <button type="submit" class="btn-add-cart">
                                Adicionar ao Carrinho
                            </button>
                        </form>
                    @else
                        <p class="empty-state">Produto fora de estoque no momento.</p>
                        <!-- faz o L -->
                    @endif
                </div>

            </div>

            <div class="product-description-section">
                <h3>Descrição do Produto</h3>
                <p>{{ $produto->description ?? 'não tem descrição desse produto.' }}</p>
            </div>

        </div>
    </main>

</body>
<x-footer />

</html>