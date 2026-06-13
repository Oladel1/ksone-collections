<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->foreignId('product_id')->nullable()->constrained()->nullOnDelete();
            $table->string('product_name');
            $table->string('product_image')->nullable();
            $table->string('variant')->nullable();
            $table->string('size')->nullable();
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone')->nullable();
            $table->unsignedInteger('amount'); // in Naira
            $table->string('currency', 3)->default('NGN');
            $table->string('status')->default('pending'); // pending, success, failed, refunded
            $table->string('gateway_response')->nullable();
            $table->string('channel')->default('paystack'); // paystack, whatsapp, manual
            $table->timestamp('paid_at')->nullable();
            $table->json('paystack_data')->nullable();
            $table->timestamps();

            $table->index('status');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
