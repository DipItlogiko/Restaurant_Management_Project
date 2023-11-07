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
            $table->string('food_name');
            $table->string('food_image');
            $table->string('price');
            $table->string('quantity');
            $table->string('payment');
            $table->string('order_status')->default('processing'); //// here i have difiended the default value 'processing' of order_status column
            $table->string('user_id');
            $table->string('user_address');
            $table->string('number');
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
