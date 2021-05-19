<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStkCallbacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stk_callbacks', function (Blueprint $table) {
            $table->id();
            $table->string('merchant_request_id')->index();
            $table->string('checkout_request_id')->index();
            $table->foreign('checkout_request_id')
                ->references('checkout_request_id')
                ->on('stk_requests')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('result_code');
            $table->string('result_desc', 200)->default('');
            $table->float('amount')->nullable();
            $table->string('mpesa_receipt_number')->nullable();
            $table->string('balance')->nullable()->nullable();
            $table->string('transaction_date')->nullable();
            $table->string('phone_number')->nullable();
            $table->enum('status', ['Success', 'Failed', 'Cancelled']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stk_callbacks');
    }
}
