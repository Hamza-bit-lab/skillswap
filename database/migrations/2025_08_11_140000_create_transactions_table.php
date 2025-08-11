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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('plan_id')->constrained()->onDelete('cascade');
            $table->string('paypal_order_id')->nullable();
            $table->string('paypal_payment_id')->nullable();
            $table->string('paypal_subscription_id')->nullable();
            $table->decimal('amount', 10, 2);
            $table->string('currency', 3)->default('USD');
            $table->enum('status', ['pending', 'completed', 'failed', 'cancelled'])->default('pending');
            $table->enum('payment_type', ['one_time', 'subscription'])->default('one_time');
            $table->string('billing_period')->nullable(); // monthly, yearly
            $table->timestamp('paid_at')->nullable();
            $table->json('paypal_response')->nullable(); // Store full PayPal response
            $table->timestamps();
            
            $table->index(['user_id', 'status']);
            $table->index('paypal_order_id');
            $table->index('paypal_payment_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
