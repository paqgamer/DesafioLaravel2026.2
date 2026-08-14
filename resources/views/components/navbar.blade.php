<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">

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

        <button type="submit">
            <span class="material-symbols-outlined">
                search
            </span>
        </button>
    </form> <a class="login" href="/login">
        Login
    </a>

    <a class="cart-button-landing">
    <span class="material-symbols-outlined">
shopping_cart
</span>    Carrinho
    </a>

</header>
