<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\ProductController as PublicProductController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\EmailController as AdminEmailController;

Route::middleware(['auth'])->group(function () {


Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/produtos/{id}', [PublicProductController::class, 'show'])->name('products.show');


    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['verified'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // crud foda
    Route::prefix('admin')->name('admin.')->group(function () {

        Route::resource('products', AdminProductController::class);

    });

    Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
// que desgraça, era melhor  abrir  o  gmail e enviar.
        Route::get('/emails', [AdminEmailController::class, 'create'])->name('emails.create');
        Route::post('/emails', [AdminEmailController::class, 'send'])->name('emails.send');

    });

});

require __DIR__.'/auth.php';