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
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->timestamp('order_date')->nullable();
            $table->string('status');
            $table->decimal('total_price',10,2);
            $table->text('address');
            $table->string('payment_method');
            $table->string('username');
            $table->string('phone');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
