<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('products_id')->unsigned()->nullable();
            $table->integer('customers_id')->unsigned()->nullable();
            $table->integer('qty')->unsigned()->nullable();
            $table->integer('rate')->unsigned()->nullable();
            $table->integer('total_amount')->unsigned()->nullable();
            $table->string('created_at')->nullable();
            $table->boolean('complete')->default(0);

            $table->foreign('products_id')
                ->references('id')
                ->on('products')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('customers_id')
                ->references('id')
                ->on('customers')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function ($table)
        {
            $table->dropForeign('orders_products_id_foreign');
            $table->dropForeign('orders_customers_id_foreign');
            $table->drop();
        });
    }
}
