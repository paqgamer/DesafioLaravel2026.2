<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{

    private function baseQuery(Request $request)
    {
        return OrderItem::whereHas('order', fn ($q) => $q->where('status', 'pago')
            ->where('user_id', $request->user()->id))
            ->with(['product.category', 'product.user', 'order']);
    }

    public function index(Request $request)
    {
        $compras = $this->baseQuery($request)->latest()->paginate(15);

        return view('purchases.index', compact('compras'));
    }

    private function validarPeriodo(Request $request): array
    {
        return $request->validate([
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date|after_or_equal:data_inicio',
        ]);
    }

    public function reportPdf(Request $request)
    {
        $periodo = $this->validarPeriodo($request);

        $compras = $this->baseQuery($request)
            ->whereHas('order', function ($q) use ($periodo) {
                $q->whereBetween('paid_at', [
                    $periodo['data_inicio'] . ' 00:00:00',
                    $periodo['data_fim'] . ' 23:59:59',
                ]);
            })
            ->get();

        $pdf = Pdf::loadView('purchases.report_pdf', [
            'compras' => $compras,
            'periodo' => $periodo,
            'comprador' => $request->user()->name,
        ]);

        return $pdf->stream('relatorio-compras.pdf');
    }
}