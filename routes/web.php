<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController as PublicProductController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\EmailController as AdminEmailController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\CepController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\PurchaseController;

Route::post('/webhooks/mercadopago', [CheckoutController::class, 'webhook'])->name('checkout.webhook');

Route::get('/api/cep/{cep}', [CepController::class, 'show'])->name('api.cep.show');

Route::middleware(['auth'])->group(function () {


    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/produtos/{id}', [PublicProductController::class, 'show'])->name('products.show');


    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['verified'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/carrinho', [CartController::class, 'index'])->name('cart.index');
    Route::post('/carrinho/adicionar/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/carrinho/{item}', [CartController::class, 'updateQuantity'])->name('cart.update');
    Route::delete('/carrinho/{item}', [CartController::class, 'remove'])->name('cart.remove');

    Route::post('/checkout/redirecionar', [CheckoutController::class, 'redirect'])->name('checkout.redirect');
    Route::get('/checkout/sucesso', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::get('/checkout/falha', [CheckoutController::class, 'failure'])->name('checkout.failure');
    Route::get('/checkout/pendente', [CheckoutController::class, 'pending'])->name('checkout.pending');

    Route::get('/vendas', [SaleController::class, 'index'])->name('sales.index');
    Route::get('/vendas/relatorio/pdf', [SaleController::class, 'reportPdf'])->name('sales.report.pdf');
    Route::get('/vendas/relatorio/xlsx', [SaleController::class, 'reportXlsx'])
        ->middleware('admin')
        ->name('sales.report.xlsx');

    Route::get('/compras', [PurchaseController::class, 'index'])->name('purchases.index');
    Route::get('/compras/relatorio/pdf', [PurchaseController::class, 'reportPdf'])->name('purchases.report.pdf');

    // nao é  tão foda  assim
    Route::prefix('admin')->name('admin.')->group(function () {

        Route::resource('products', AdminProductController::class);

    });

    Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {

        Route::get('/emails', [AdminEmailController::class, 'create'])->name('emails.create');
        Route::post('/emails', [AdminEmailController::class, 'send'])->name('emails.send');

        Route::resource('users', AdminUserController::class)->only(['index', 'create', 'store', 'update', 'destroy']);

    });

});

require __DIR__ . '/auth.php';