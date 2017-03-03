<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BannerCustoms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('banner_customs',function(Blueprint $table){
            $table->increments('id');
            $table->integer('banner_id')->unsigned();
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
            $table->foreign('banner_id')->references('id')->on('banners');
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
        Schema::dropIfExists('banner_customs');
    }
}
