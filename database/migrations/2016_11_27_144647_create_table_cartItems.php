<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCartItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cartItem', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('spare_id')->unsigned();
            $table->integer('cart_id')->unsigned();

            $table->rememberToken();
            $table->timestamps();
            $table->foreign('spare_id')->references('id')->on('spares');
            $table->foreign('cart_id')->references('id')->on('shoppingCart');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
