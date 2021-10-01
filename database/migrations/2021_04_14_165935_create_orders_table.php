<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('address_id')->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('coupon_id')->nullable()->constrained();
            $table->string('order_no', 100)->unique();
            $table->integer('phone');
            $table->float('discount')->default(0);
            $table->float('delivery_fee')->default(0.0);
            $table->enum('payment_method', ['cash', 'm-pesa', 'paypal']);
            $table->enum('payment_type', ['on-delivery', 'instant']);
            $table->double('total');
            $table->string('courier', 30)->default('');
            $table->string('tracking_number')->default(0);
            $table->string('status', 20)->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
}
