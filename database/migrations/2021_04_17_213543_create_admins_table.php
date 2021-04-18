<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 20);
            $table->string('last_name', 20);
            $table->string('username', 20)->unique()->nullable();
            $table->enum('gender', ['Male', 'Female']);
            $table->string('image')->nullable();
            $table->integer('national_id')->unique();
            $table->enum('type', ['Seller', 'Admin', 'Super']);
            $table->integer('pin')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->ipAddress('ip_address');
            $table->string('email', 50)->unique();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void {
        Schema::dropIfExists('admins');
    }
}
