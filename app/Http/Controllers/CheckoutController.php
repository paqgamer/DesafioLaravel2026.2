<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;

class CheckoutController extends Controller
{
    public function __construct()
    {
        // falta  pegar o token, vou  ver se libera
        MercadoPagoConfig::setAccessToken(config('services.mercadopago.access_token'));

        if (! app()->environment('production')) {
            MercadoPagoConfig::setRuntimeEnviroment(MercadoPagoConfig::LOCAL);
        }
    }


    // da confirmacao e  referencia
    public function redirect(Request $request)
    {
        $carrinho = Order::where('user_id', $request->user()->id)
            ->where('status', 'carrinho')
            ->with('items.product')
            ->firstOrFail();

        abort_if($carrinho->items->isEmpty(), 400, 'Carrinho vazio.');

        $items = $carrinho->items->map(fn ($item) => [
            'id' => (string) $item->product_id,
            'title' => $item->product->name,
            'quantity' => $item->quantity,
            'unit_price' => (float) $item->unit_price,
            'currency_id' => 'BRL',
        ])->toArray();

        $client = new PreferenceClient();

        try {
            $preference = $client->create([
                'items' => $items,
                'payer' => [
                    'name' => $request->user()->name,
                    'email' => $request->user()->email,
                ],
                //identifica o pedido pela sdk  direto no servidor do MP\
                'external_reference' => (string) $carrinho->id,
                'back_urls' => [
                    'success' => route('checkout.success'),
                    'failure' => route('checkout.failure'),
                    'pending' => route('checkout.pending'),
                ],
                'auto_return' => 'approved',
                'notification_url' => route('checkout.webhook'),
            ]);
        } catch (MPApiException $e) {
            Log::error('Erro ao criar preferência Mercado Pago', [
                'erro' => $e->getMessage(),
                'resposta' => $e->getApiResponse()?->getContent(),
            ]);

            return back()->with('error', 'Não foi possível iniciar o pagamento. Tente novamente.');
        }

// test  para producao
        $initPoint = app()->environment('production')
            ? $preference->init_point
            : $preference->sandbox_init_point;

        return redirect($initPoint);
    }

    public function success(Request $request)
    {
        return view('checkout.success');
    }

    public function pending(Request $request)
    {
        return view('checkout.pending');
    }

    public function failure(Request $request)
    {
        return redirect()
            ->route('cart.index')
            ->with('error', 'Pagamento não concluído. Seu carrinho continua salvo, tente novamente.');
    }

  
    
    public function webhook(Request $request)
    {
        $paymentId = $request->input('data.id') ?? $request->query('id');

        if (! $paymentId) {
            return response()->json(['status' => 'ignored'], 200);
        }

        try {
            $payment = (new PaymentClient())->get($paymentId);
        } catch (\Throwable $e) {
            Log::error('Erro ao consultar pagamento Mercado Pago', ['erro' => $e->getMessage()]);

            return response()->json(['status' => 'error'], 200);
        }

        if ($payment->status !== 'approved') {
            return response()->json(['status' => 'ignored'], 200);
        }

        $carrinho = Order::with('items.product')->find($payment->external_reference);


        // webhhok repedido
        if (! $carrinho || $carrinho->status !== 'carrinho') {
            return response()->json(['status' => 'ok'], 200);
        }

        foreach ($carrinho->items as $item) {
            $item->product->decrement('stock_quantity', $item->quantity);
        }

        $carrinho->update(['status' => 'pago']);

        return response()->json(['status' => 'ok'], 200);
    }
}