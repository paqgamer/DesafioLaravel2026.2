<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" type="image/x-icon" href="{{ asset('image/favicon.svg') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
    <title>De$af.io | O Futuro da Tecnologia</title>
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
</head>

<body>
    <x-navbar :categorias="$categorias" />

    <section class="hero">
        <div class="hero-content">
            <div class="minhamarcaépika-animated">
                <img src="{{ asset('image/alogodesafio.png') }}" alt="De$afio" height="60">
            </div>
            <h1 class="hero-title">O Futuro da Tecnologia na Sua Mão</h1>
            <p class="hero-subtitle">O passado  também</p> 
            <!-- por que não? -->
            <a href="#catalogo" class="btn-scroll">Explorar Catálogo</a>
        </div>
    </section>
    <!-- agora vai ficar  pika -->
    <section class="presentation">
        <div class="presentation-content">
            <h2>Por que escolher a De$af.io?</h2>
            <p>Esse aqui é o melhor jeito de se comprar um eletrônico. Você não acredita?  Role para baixo e veja por si só, temos produtos de qualidade exclusiva!!</p>
        </div>
    </section>
<!-- redirectzinho maroto -->
    <section id="catalogo" class="products-section">
        <h3 class="section-title">Destaques da Semana</h3>
        
        <div class="products">
            @foreach ($produtos as $produto)
            <a href="{{ route('products.show', $produto->id) }}" class="card-link">
                <div class="card">
                    <img src="{{ asset('storage/' . $produto->image_url)}}" alt="Foto de {{ $produto->name }}"> 
                    <div class="card-content">
                        <span class="category-badge">
                            {{ $produto->category->name ?? 'Sem categoria' }}
                        </span>

                        <div class="title">
                            {{ $produto->name }}
                        </div>

                        <div class="price-row">
                            <p class="price">{{ format_price($produto->price) }}</p>
                            <button class="buy">Comprar</button>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </section>

    <!-- finalmente,  um footer,  Eu  tinha esquecido -->
<x-footer />
</body>
</html>