<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVariationsOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('variations_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('variation_id')->constrained()->onDelete('cascade');
            $table->string('variant');
            $table->float('extra_price')->default(0);
            $table->integer('stock')->default(1);
            $table->string('image')->nullable();
            $table->tinyInteger('status')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('variation_options');
    }
}
