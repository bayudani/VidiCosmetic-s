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
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            // $table->foreignId('order_id')->constrained('order_items')->onDelete('cascade');
            $table->string('order_number')->unique();
            $table->decimal('total_amount', 20, 2);
            $table->enum('order_status', ['pending', 'completed', 'processing', 'cancelled'])->default('pending'); //nnti edit ad processing
            $table->enum('payment_status', ['unpaid', 'paid','failed'])->default('unpaid');
            $table->string('payment_method')->nullable();
            $table->text('shipping_address');
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
