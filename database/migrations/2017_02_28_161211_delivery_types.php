<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeliveryTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('delivery_types',function(Blueprint $table){
            $table->increments('id');
            $table->string('name',100);
            $table->string('abbr',10);
        });

        Schema::table('delivery_types',function(Blueprint $table){
            $sql="INSERT INTO delivery_types(name,abbr) VALUES('HTML5 Standard','STAND');";
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
         Schema::dropIfExists('delivery_types');
    }
}
