<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained();
            $table->bigInteger('seller_id')->unsigned();
            $table->foreign('seller_id')->references('user_id')->on('sellers');
            $table->string('title');
            $table->string('main_image');
            $table->string('keywords')->nullable();
            $table->string('description')->nullable();
            $table->string('label', 10)->nullable();
            $table->float('base_price');
            $table->float('sale_price')->default(0);
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
        Schema::dropIfExists('products');
    }
}
