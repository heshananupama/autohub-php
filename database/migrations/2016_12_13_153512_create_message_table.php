<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('messageType');
            $table->integer('user_id')->unsigned();
            $table->integer('retailer_id')->unsigned();
            $table->rememberToken();
            $table->timestamps();
            $table->string('message', 1000);
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('retailer_id')->references('id')->on('users');



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
