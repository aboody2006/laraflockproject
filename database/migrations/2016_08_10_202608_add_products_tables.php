<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProductsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
        });

        Schema::create('sections', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned();
            $table->string('title');

            $table->foreign('category_id')->references('id')->on('categories');
        });

        Schema::create('products', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('section_id')->unsigned();
            $table->string('code');
            $table->string('title');
            $table->timestamps();

            $table->foreign('section_id')->references('id')->on('sections');
        });

        Schema::create('characteristics', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->float('length');
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products');
        });

        Schema::create('units', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('symbol');
        });

        Schema::create('weights', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->integer('unit_id')->unsigned();
            $table->float('full_weight');
            $table->float('half_weight');
            $table->float('average');
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('unit_id')->references('id')->on('units');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('weights');
        Schema::drop('units');
        Schema::drop('characteristics');
        Schema::drop('products');
        Schema::drop('sections');
        Schema::drop('categories');

    }
}
