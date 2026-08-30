<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Illuminate\Support\Enumerable;
// Viva o  reddit, quase infartei, e era o enumerable faltando
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SalesExport implements FromCollection, WithHeadings, WithMapping
{
    public function __construct(private Collection $vendas)
    {
    }

    public function collection(): Enumerable
    {
        return $this->vendas;
    }
    // como dizia ventania,  eu vou  sair desse  marasmo, vou morar num matagal

    public function headings(): array
    {
        return ['Data', 'Valor', 'Categoria do Produto', 'Usuário que Comprou', 'Usuário que Vendeu'];
    }

    public function map($item): array
    {
        return [
            optional($item->order->paid_at)->format('d/m/Y H:i'),
            number_format($item->quantity * $item->unit_price, 2, ',', '.'),
            $item->product->category->name ?? 'Sem Categoria',
            $item->order->user->name,
            $item->product->user->name,
        ];
    }
}