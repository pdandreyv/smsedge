<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSendLogAggregatedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('send_log_aggregateds', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('usr_id')->unsigned();
            $table->integer('cnt_id')->unsigned();
            $table->integer('count_success');
            $table->integer('count_failed');
            $table->date('date_at');
            $table->foreign('usr_id')->references('usr_id')->on('users');
            $table->foreign('cnt_id')->references('cnt_id')->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('send_log_aggregateds');
    }
}
