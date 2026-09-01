<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600;14..32,700&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <title>Histórico de Compras | De$af.io</title>
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="{{ asset('css/admproducts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/modaledit.css') }}">
</head>

<body>

    <x-navbar :categorias="[]" />

    <main class="admin-container">

        <div class="admin-header">
            <div>
                <h1>Histórico de Compras</h1>
                <p>Suas compras realizadas na plataforma.</p>
            </div>
        </div>

        <form action="{{ route('purchases.report.pdf') }}" method="GET" target="_blank" class="form-card"
            style="margin-bottom: 24px;">
            <strong>Gerar relatório por período</strong>
            <div class="form-row" style="margin-top: 12px; align-items: flex-end;">
                <div class="form-group">
                    <label for="data_inicio">De</label>
                    <input type="date" id="data_inicio" name="data_inicio" required>
                </div>
                <div class="form-group">
                    <label for="data_fim">Até</label>
                    <input type="date" id="data_fim" name="data_fim" required>
                </div>
                <button type="submit" class="btn-save">Gerar PDF</button>
            </div>
        </form>

        <div class="table-card">
            <table class="products-table">
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Produto</th>
                        <th>Data da Compra</th>
                        <th>Valor</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($compras as $item)
                        <tr>
                            <td>
                                <img src="{{ asset('storage/' . $item->product->image_url) }}"
                                    alt="{{ $item->product->name }}" class="product-thumb">
                            </td>
                            <td class="font-bold">{{ $item->product->name }}</td>
                            <td>{{ optional($item->order->paid_at)->format('d/m/Y H:i') }}</td>
                            <td class="price">{{ format_price($item->quantity * $item->unit_price) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="empty-state">
                                Você ainda não fez nenhuma compra. <a href="{{ route('home') }}">Ver produtos</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="pagination-container">
                {{ $compras->links() }}
            </div>
        </div>

    </main>

</body>

</html>