<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->enum('option', ['Manual', 'Automatic']);
            $table->string('code', 100)->unique();
            $table->text('categories');
            $table->text('users');
            $table->enum('coupon_type', ['Single', 'Multiple']);
            $table->enum('amount_type', ['Percent', 'Fixed']);
            $table->float('amount');
            $table->date('expiry');
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('coupons');
    }
}
