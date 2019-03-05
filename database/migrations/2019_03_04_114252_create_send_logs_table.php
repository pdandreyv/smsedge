<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSendLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('send_logs', function (Blueprint $table) {
            $table->increments('log_id');
            $table->integer('usr_id');
            $table->integer('num_id');
            $table->string('log_message');
            $table->boolean('log_success');
            $table->timestamps();
            $table->foreign('usr_id')->references('usr_id')->on('users');
            $table->foreign('num_id')->references('num_id')->on('numbers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('send_logs');
    }
}
