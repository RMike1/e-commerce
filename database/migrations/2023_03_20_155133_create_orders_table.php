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
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('second_name');
            $table->string('company')->nullable();
            $table->string('country');
            $table->string('town');
            $table->string('state');
            $table->string('street');
            $table->string('phone');
            $table->string('email');
            $table->string('quantity');
            $table->string('shipping_method');
            $table->string('payment_method')->nullable();
            $table->string('delivery_status')->nullable();
            $table->string('tot_amount')->nullable();
            $table->mediumText('note')->nullable();
            $table->foreignId('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('orders');
    }
}
