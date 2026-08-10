<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600&display=swap"
        rel="stylesheet">
    <title>De$af.io</title>
    <!--sinceramente, essa viadagem do laravel de asset é foda
    prefiria usar o caminho simples "/arquiv/etc" mas um fdp no reddit falou que nao pode, mesmo que funcione
    -->
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
</head>

<body>
    {{-- Vou separar a navbar ainda --}}
    <header class="navbar">

        <a class="logo" href="/">
            <img src="{{ asset('image/alogodesafio.png') }}" alt="De$afio" height="40">
        </a>

        <form action="/" method="GET" class="search">
            <select class="category" name="category_id">
                <option value="">Todas as Categorias</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}"
                        {{ request('category_id') == $categoria->id ? 'selected' : '' }}>
                        {{ $categoria->name }}
                    </option>
                @endforeach
            </select>

            <input type="text" name="search" placeholder="Buscar produtos..." value="{{ request('search') }}">

            <button type="submit" style="display: none;">Buscar</button>
        </form>

        <a class="login" href="/login">
            Login
        </a>

        <button class="cart-button-landing">
            🛒 Carrinho
        </button>

    </header>

    {{-- ARRUMAR ISSO AQUI --}}
    <section class="hero">
        <div class="banner">
            <h2>Os melhores Produtos Aqui no</h2>
            <div class="brand">
                <img src="{{ asset('image/alogodesafio.png') }}" alt="De$afio" height="40">
            </div>
        </div>
    </section>


    <section class="products">
        @foreach ($produtos as $produto)
            <div class="card">
                <img src="{{ asset($produto->image_url) }}" alt="Foto de {{ $produto->name }}"> 
                {{-- enfiei a categoria no card pq fica mais inuitivo --}}
                <div class="card-content">
                    <span class="category-badge">
                        {{ $produto->category->name ?? 'Sem categoria' }}
                    </span>

                    <div class="title">
                        {{ $produto->name }}
                    </div>

                    <div class="price">
                        <p class="product-price">{{ format_price($produto->price) }}</p>
                        <button class="buy">Comprar</button>
                    </div>
                </div>
            </div>
        @endforeach
    </section>

</body>

</html>
