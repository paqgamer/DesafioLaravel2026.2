<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamento Aprovado | De$af.io</title>
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admproducts.css') }}">
</head>
<body>
    <x-navbar :categorias="[]" />
    <main class="admin-container">
        <div class="alert-success">
            <span class="material-symbols-outlined">check_circle</span>
            Pagamento aprovado! Seu pedido foi confirmado.
        </div>
        <p>A confirmacao pode demorar alguns isntantes.</p>
        <a href="{{ route('home') }}" class="btn-create" style="display: inline-flex; margin-top: 16px;">Voltar aos produtos</a>
    </main>
</body>
</html>