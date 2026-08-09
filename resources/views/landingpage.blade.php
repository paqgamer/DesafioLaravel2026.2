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

        <div class="logo">
            <img src="{{ asset('image/alogodesafio.png') }}" alt="De$afio" height="40">
        </div>

        <div class="search">
            <select class="category">
                <option>Categoria</option>
            </select>
            <input type="text" name="search" placeholder="Buscar produtos...">
        </div>

        <button class="login">
            Login
        </button>

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
                    {{-- isso aqui ta temporario pra funcionar com o lorempicsum --}}
              <img src="{{ $produto->image_url }}" alt="Foto de {{ $produto->name }}">

                <div class="card-content">
                    <div class="title">
                        {{ $produto->name }}
                    </div>

                    <div class="price">

                        R$ {{ number_format($produto->price, 2, ',', '.') }}
                        <button class="buy">Comprar</button>
                    </div>
                </div>
            </div>
        @endforeach

    </section>

</body>

</html>
