<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('usr_id');
            $table->string('usr_name');
            $table->boolean('usr_active');
            $table->timestamps();
        });
        $data = [];
        $names = ['Nike','Yuri','Mikhail','Mike','Tom','Andrey','Boris','Alexandr','Dima','Denis'];
        for($i=0;$i<10;$i++){
            $data[] = [
                'usr_name' => $names[$i],
            ];
        }
        
        DB::table('countries')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
