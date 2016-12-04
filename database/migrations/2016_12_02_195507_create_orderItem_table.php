<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderItem', function (Blueprint $table) {


            $table->increments('id');
            $table->integer('quantity');
            $table->string('orderStatus');

            $table->date('orderItemCompletedDate');
            $table->double('subTotal');
            $table->integer('order_id')->unsigned();
            $table->integer('spare_id')->unsigned();

            $table->rememberToken();
            $table->timestamps();
            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('spare_id')->references('id')->on('spares');



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
