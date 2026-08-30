<?php

namespace App\Http\Controllers;

use App\Exports\SalesExport;
use App\Models\OrderItem;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
// como que essa  merda funciona??
use Maatwebsite\Excel\Facades\Excel;
// meu tempo ta acabando, eu não devia ter  perdido meu  tempo arrumando footer e lp.
class SaleController extends Controller
{

    private function baseQuery(Request $request)
    {
        $query = OrderItem::whereHas('order', fn ($q) => $q->where('status', 'pago'))
            ->with(['product.category', 'product.user', 'order.user']);

        if (! $request->user()->is_admin) {
            $query->whereHas('product', fn ($q) => $q->where('user_id', $request->user()->id));
        }

        return $query;
    }

    public function index(Request $request)
    {
        $vendas = $this->baseQuery($request)
            ->latest()
            ->paginate(15);

        return view('sales.index', compact('vendas'));
    }

    private function validarPeriodo(Request $request): array
    {
        return $request->validate([
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date|after_or_equal:data_inicio',
        ]);
    }

    private function vendasDoPeriodo(Request $request, array $periodo)
    {
        return $this->baseQuery($request)
            ->whereHas('order', function ($q) use ($periodo) {
                $q->whereBetween('paid_at', [
                    $periodo['data_inicio'] . ' 00:00:00',
                    $periodo['data_fim'] . ' 23:59:59',
                ]);
            })
            ->get();
    }

    public function reportPdf(Request $request)
    {
        $periodo = $this->validarPeriodo($request);
        $vendas = $this->vendasDoPeriodo($request, $periodo);

        $pdf = Pdf::loadView('sales.report_pdf', [
            'vendas' => $vendas,
            'periodo' => $periodo,
        ]);


        return $pdf->stream('relatorio-vendas.pdf');
    }

  
    public function reportXlsx(Request $request)
    {
        abort_if(! $request->user()->is_admin, 403);

        $periodo = $this->validarPeriodo($request);
        $vendas = $this->vendasDoPeriodo($request, $periodo);

        return Excel::download(new SalesExport($vendas), 'relatorio-vendas.xlsx');
    }
}