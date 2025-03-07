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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('payment_number')->unique()->nullable(false);
            $table->float('price')->default(0);
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('merchant_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('transaction_type_id');
            $table->unsignedBigInteger('payment_method_id');
            $table->boolean('discounted')->default(false);
            $table->string('note')->nullable();
            $table->dateTime('payment_date')->default(now());
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->nullOnDelete();
            $table->foreign('merchant_id')->references('id')->on('merchants');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('transaction_type_id')->references('id')->on('transaction_types');
            $table->foreign('payment_method_id')->references('id')->on('payment_methods');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
