<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->decimal('total_amount', 10, 2);
        $table->string('status')->default('pending');
        
        // Da tabela de user
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        
        // I hope this will be enough to store created and updated dates etc.
        $table->timestamps(); 
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
