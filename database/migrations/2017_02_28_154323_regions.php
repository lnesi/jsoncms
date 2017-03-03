<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Regions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('regions',function(Blueprint $table){
             $table->increments('id');
             $table->integer('partner_id')->unsigned();
             $table->string('name',100);
             $table->string('abbr',10);
             $table->boolean('active')->default(TRUE);
             $table->softDeletes();
             $table->timestamps();
        });

        Schema::create('country_region',function(Blueprint $table){
             $table->integer('region_id')->unsigned()->index();
             $table->integer('country_id')->unsigned()->index();
             $table->foreign('region_id')->references('id')->on('regions')->onDelete('cascade');
             $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
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
        Schema::dropIfExists('country_region');
        Schema::dropIfExists('regions');
    }
}
