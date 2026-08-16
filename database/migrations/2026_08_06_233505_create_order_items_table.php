<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{


    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
            $table->decimal('unit_price', 10, 2);

            //chaves estrangeiras
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->onDelete('restrict');
                // deletar  produto que ja foi comprado daria uma  merda  grande, nao sei como vou  resolver
            $table->timestamps();
        });
    }

 
    
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
// I might admmit the laravel structure makes many things easier.