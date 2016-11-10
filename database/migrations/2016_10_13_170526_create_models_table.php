<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('models', function (Blueprint $table) {
            $table->increments('id');
            $table->string('modelName');
            $table->string('transmissionType');
            $table->string('fuelType');
            $table->string('engineCapacity');

            $table->string('countryMade');
            $table->integer('admin_id')->unsigned();
            $table->string('brandName');
            $table->smallInteger('yearOfManufacture');
            $table->timestamps();

            $table->foreign('admin_id')->references('id')->on('users');
            $table->foreign('brandName')->references('brandName')->on('brands');

        });    }

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
