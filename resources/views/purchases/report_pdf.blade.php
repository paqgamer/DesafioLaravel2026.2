<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <!-- quase a mesma coisa do  outro, acho q ue da tempo -->
    <meta charset="UTF-8">
    <style>
        body { font-family: Helvetica, Arial, sans-serif; font-size: 12px; color: #111827; }
        h1 { font-size: 18px; margin-bottom: 4px; }
        .periodo { color: #6b7280; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #d1d5db; padding: 6px 8px; text-align: left; }
        th { background-color: #f3f4f6; }
        .total-row td { font-weight: bold; background-color: #f9fafb; }
    </style>
</head>
<body>
    <h1>Relatório de Compras</h1>
    <p class="periodo">
        Período: {{ \Carbon\Carbon::parse($periodo['data_inicio'])->format('d/m/Y') }}
        até {{ \Carbon\Carbon::parse($periodo['data_fim'])->format('d/m/Y') }}
    </p>

    <table>
        <thead>
            <tr>
                <th>Data</th>
                <th>Valor</th>
                <th>Categoria do Produto</th>
                <th>Usuário que Comprou</th>
                <th>Usuário que Vendeu</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($compras as $item)
                <tr>
                    <td>{{ optional($item->order->paid_at)->format('d/m/Y H:i') }}</td>
                    <td>{{ format_price($item->quantity * $item->unit_price) }}</td>
                    <td>{{ $item->product->category->name ?? 'Sem Categoria' }}</td>
                    <td>{{ $comprador }}</td>
                    <td>{{ $item->product->user->name }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Nenhuma compra encontrada no período selecionado.</td>
                </tr>
            @endforelse
        </tbody>
        @if ($compras->isNotEmpty())
            <tfoot>
                <tr class="total-row">
                    <td colspan="1">Total</td>
                    <td>{{ format_price($compras->sum(fn ($i) => $i->quantity * $i->unit_price)) }}</td>
                    <td colspan="3"></td>
                </tr>
            </tfoot>
        @endif
    </table>
</body>
</html>