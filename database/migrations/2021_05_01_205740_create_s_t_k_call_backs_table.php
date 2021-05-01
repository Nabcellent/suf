<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSTKCallBacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_t_k_call_backs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('s_t_k_push_id')->constrained()->onDelete('cascade');
            $table->float('amount')->nullable();
            $table->string('receipt_number')->nullable();
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
        Schema::dropIfExists('s_t_k_call_backs');
    }
}
