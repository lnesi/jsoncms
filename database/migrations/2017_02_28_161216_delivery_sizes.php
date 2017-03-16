<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeliverySizes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('delivery_sizes',function(Blueprint $table){
            $table->increments('id');
            $table->string('name',100);
            $table->string('abbr',10);
            $table->unsignedSmallInteger('width');
            $table->unsignedSmallInteger('height');
        });
         Schema::table('delivery_sizes',function(Blueprint $table){
            $sql="INSERT INTO delivery_sizes(name,abbr,width,height) VALUES('MPU','MPU',300,250);
                  INSERT INTO delivery_sizes(name,abbr,width,height) VALUES('Half Page','HALFPAGE',300,600);
                  INSERT INTO delivery_sizes(name,abbr,width,height) VALUES('Billboard','BILLBOARD',970,250);";
            DB::connection()->getPdo()->exec($sql);
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
        Schema::dropIfExists('delivery_sizes');
    }
}
