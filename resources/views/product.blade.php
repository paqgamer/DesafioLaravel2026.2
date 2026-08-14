<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600;14..32,700&display=swap"
        rel="stylesheet">
    <title>{{ $produto->name }} | De$af.io</title>
    <link rel="stylesheet" href="{{ asset('css/product.css') }}">
</head>

<body>
    <!-- enfim, ta funcionando,  por  enquanto -->
    <x-navbar :categorias="$categorias" />

    <main class="product-page-container">
        <a href="/" class="back-link">← Voltar aos produtos</a>
        <!-- meio inutil, dá  pra clicar na logo na navbar, mas assim fica  mais intuitivo -->
        <div class="product-details-card">

            <div class="product-top-section">

                <div class="product-image-container">
                    <img src="{{ asset($produto->image_url) }}" alt="Foto de {{ $produto->name }}">
                </div>

                <div class="product-info-container">
                    <span class="category-badge">
                        {{ $produto->category->name ?? 'Sem Categoria' }}
                    </span>

                    <h1 class="product-title">{{ $produto->name }}</h1>

                    <div class="product-price-box">
                        {{ format_price($produto->price) }}
                    </div>

                    <div class="product-actions">
                        <button type="button" class="btn-buy-now">
                            Comprar Agora
                        </button>
                        <button type="button" class="btn-add-cart">
                            Adicionar ao Carrinho
                        </button>
                    </div>
                </div>

            </div>

            <div class="product-description-section">
                <h3>Descrição do Produto</h3>
                <p>{{ $produto->description ?? 'Nenhuma descrição fornecida para este produto.' }}</p>
                <!-- vou ver se é obrigatorio ter descricao  do  produto -->
            </div>

        </div>
    </main>

</body>

</html>