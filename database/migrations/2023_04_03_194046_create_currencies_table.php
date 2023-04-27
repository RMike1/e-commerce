<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

    class CreateCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('code')->comment('currency-code');
            $table->string('name');
            $table->string('symbol')->nullable()->comment('currency-symbol');
            $table->string('normal_val')->nullable()->comment('value according to Frw');
            $table->string('us_value')->comment('value according to US Dollar');
            $table->string('status')->default('1')->comment('1 for active 0 for inactive');
            $table->string('fr_use_status')->default('0')->comment('1 set to active 0 for inactive');
            $table->integer('user_id');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('currencies');
    }
}
