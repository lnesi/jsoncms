<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeliveryCustoms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('delivery_customs',function(Blueprint $table){
            $table->increments('id');
            $table->integer('delivery_id')->unsigned();
            $table->integer('component_id')->unsigned();
            $table->string('name',100);
            $table->string('key',50);
            $table->string('default_value');
            $table->text('data');
            $table->text('help_text');
            $table->boolean('active')->default(TRUE);
            $table->integer('sort_index')->unsigned();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('delivery_id')->references('id')->on('deliveries');
            $table->foreign('component_id')->references('id')->on('components');
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
        Schema::dropIfExists('delivery_customs');
    }
}
