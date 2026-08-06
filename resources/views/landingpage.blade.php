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


        <div class="card">
            <img src="produto.jpg">

            <div class="title">
                Computador semi-novo,
                roda todos os jogos
            </div>

            <div class="price">
                R$ 2199,99
                <button class="buy">
                    🛒 Comprar
                </button>
            </div>

            <div class="details">
                Ver detalhes...
            </div>
        </div>

        <!--temporario até eu implementar o for each-->
        <div class="card"><img src="produto.jpg">
            <div class="title">Computador semi-novo, roda todos os jogos</div>
            <div class="price">R$ 2199,99 <button class="buy">Comprar</button></div>
            <div class="details">Ver detalhes...</div>
        </div>
        <div class="card"><img src="produto.jpg">
            <div class="title">Computador semi-novo, roda todos os jogos</div>
            <div class="price">R$ 2199,99 <button class="buy">Comprar</button></div>
            <div class="details">Ver detalhes...</div>
        </div>
        <div class="card"><img src="produto.jpg">
            <div class="title">Computador semi-novo, roda todos os jogos</div>
            <div class="price">R$ 2199,99 <button class="buy">Comprar</button></div>
            <div class="details">Ver detalhes...</div>
        </div>

    </section>
{{-- still gonna fix the section tag, will commit for now to avoid issues later --}}

</body>

</html>
