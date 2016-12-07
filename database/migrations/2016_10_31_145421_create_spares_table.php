<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSparesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spares', function (Blueprint $table) {
            $table->increments('id');
            $table->string('partNumber');
            $table->integer('quantity');
            $table->double('price');
            $table->string('warranty');

            $table->integer('retailer_id')->unsigned();
            $table->integer('brand_id')->unsigned();
            $table->integer('model_id')->unsigned();
            $table->integer('category_id')->unsigned();


            $table->string('description');
            $table->string('imagePath') ;
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('retailer_id')->references('id')->on('users');
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->foreign('model_id')->references('id')->on('models');
            $table->foreign('category_id')->references('id')->on('categories');



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
