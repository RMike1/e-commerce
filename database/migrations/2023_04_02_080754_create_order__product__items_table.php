<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order__product__items', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->string('product_price');
            $table->string('product_quantity');
            $table->string('product_total');
            $table->foreignId('purchase_orders_id')->references('id')->on('purchase__orders')->cascade('delete');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('order__product__items');
    }
}
