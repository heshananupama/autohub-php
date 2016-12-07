<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->increments('id');
            $table->string('feedbackType');
            $table->double('rating');
            $table->string('description',1000);
            $table->string('feedbackStatus');
            $table->string('phoneNumber');


            $table->timestamps();
            $table->integer('orderItem_id')->unsigned();
            $table->integer('user_id')->unsigned();

            $table->foreign('orderItem_id')->references('id')->on('orderItem');
            $table->foreign('user_id')->references('id')->on('users');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feedback');

    }
}

