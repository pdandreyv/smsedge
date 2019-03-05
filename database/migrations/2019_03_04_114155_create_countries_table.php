<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->increments('cnt_id');
            $table->string('cnt_code');
            $table->string('cnt_title');
            $table->timestamps();
        });
        
        $data = [];
        $codes = ['RU','UA','US','EN','GB','BG','ND','SP','GR','CZ'];
        $titles = ['Russia','Ukrane','Unated States','England','Germany','Belgia','Niderland','Spain','Greece','Czech'];
        for($i=0;$i<10;$i++){
            $data[] = [
                'cnt_code' => $codes[$i],
                'cnt_title' => $titles[$i],
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
        Schema::dropIfExists('countries');
    }
}
