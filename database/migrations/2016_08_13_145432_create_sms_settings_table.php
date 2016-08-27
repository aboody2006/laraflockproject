<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_settings', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('username');
            $table->string('password');
            $table->string('sender');
            $table->integer('user_id')->unsigned();
            $table->string('api_url');

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
        Schema::table('sms_settings', function ($table)
        {
            $table->dropForeign('sms_settings_user_id_foreign');
            $table->drop();
        });
    }
}
