<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BannerSet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('status',function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
        });

        Schema::table('status',function(Blueprint $table){
            $sql="INSERT INTO status(name) VALUES('Draft'),('Live'),('Expire');";
            DB::connection()->getPdo()->exec($sql);
        });
        

        Schema::create('banner_sets',function(Blueprint $table){
            $table->increments('id');
            $table->integer('banner_id')->unsigned();
            $table->string('name');
            $table->integer('status_id')->unsigned();
            $table->unsignedSmallInteger('rotation');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('banner_id')->references('id')->on('banners')->onDelete('cascade');
            $table->foreign('status_id')->references('id')->on('status');

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
        Schema::dropIfExists('banner_sets');
        Schema::dropIfExists('status');
    }
}
