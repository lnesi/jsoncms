<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CustomValues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('custom_values',function(Blueprint $table){
            $table->increments('id');
            $table->integer('set_id')->unsigned();
            $table->integer('custom_id')->unsigned();
            $table->binary('data');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('set_id')->references('id')->on('banner_sets')->onDelete('cascade');
            $table->foreign('custom_id')->references('id')->on('banner_customs')->onDelete('cascade');;
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
        Schema::dropIfExists('custom_values');
    }
}
