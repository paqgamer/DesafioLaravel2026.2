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

    <!-- ex1 -->
    <div class="card">
        <img src="{{ asset('image/produto.jpg') }}" alt="Computador semi-novo">
        <div class="card-body">
            <div class="title">Computador semi-novo, roda todos os jogos pesados sem travar</div>
            <div class="price-row">
                <span class="price">R$ 2.199,99</span>
            </div>
            <button class="buy">Comprar</button>
        </div>
    </div>

    <!-- Exemplo2-->
    <div class="card">
        <img src="{{ asset('image/teclado.jpg') }}" alt="Teclado Mecânico">
        <div class="card-body">
            <div class="title">Teclado mecainico sswtich Blue RGB</div>
            <div class="price-row">
                <span class="price">R$ 150,00</span>
            </div>
            <button class="buy">Comprar</button>
        </div>
    </div>

    <!-- card 3 -->
    <div class="card">
        <img src="{{ asset('image/mouse.jpg') }}" alt="Mouse Gamer">
        <div class="card-body">
            <div class="title">Mouse Gamer 10000 DPI com botões laterais configuráveis</div>
            <div class="price-row">
                <span class="price">R$ 89,90</span>
            </div>
            <button class="buy">Comprar</button>
        </div>
    </div>

    <!-- exemplo 4 -->
    <div class="card">
        <img src="{{ asset('image/fone.jpg') }}" alt="Headset Gamer">
        <div class="card-body">
            <div class="title">Headset Surround 7.1 Microfone Noise Cancelling</div>
            <div class="price-row">
                <span class="price">R$ 230,00</span>
            </div>
            <button class="buy">Comprar</button>
        </div>
    </div>

    <!-- card 5 -->
    <div class="card">
        <img src="{{ asset('image/monitor.webp') }}" alt="Monitor 144hz">
        <div class="card-body">
            <div class="title">Monitor Gamer 24 (la ele) 144hz 1ms IPS</div>
            <div class="price-row">
                <span class="price">R$ 950,00</span>
            </div>
            <button class="buy">Comprar</button>
        </div>
    </div>

</section>

</body>

</html>
