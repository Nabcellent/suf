<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void {
        Schema::create('products', function(Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained();
            $table->bigInteger('seller_id')->unsigned();
            $table->foreign('seller_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('brand_id')->default(0);
            $table->string('title');
            $table->string('image')->nullable();
            $table->string('keywords')->nullable();
            $table->string('description')->nullable();
            $table->string('label', 10)->nullable();
            $table->float('base_price');
            $table->float('discount')->default(0);
            $table->integer('stock')->default(0);
            $table->boolean('is_featured')->default(true);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('products');
        Schema::enableForeignKeyConstraints();
    }
}
