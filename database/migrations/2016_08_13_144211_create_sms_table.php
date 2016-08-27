<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('message')->nullable();
            $table->string('recipient_number');
            $table->integer('user_id')->unsigned();
            $table->string('sent_date');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::table('sms', function ($table)
        {
            $table->dropForeign('sms_user_id_foreign');
            $table->drop();
        });
    }
}