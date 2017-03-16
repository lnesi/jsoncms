<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Deliveries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('deliveries',function(Blueprint $table){
            $table->increments('id');
            $table->integer('partner_id')->unsigned();
            $table->integer('campaign_id')->unsigned();
            $table->integer('country_id')->unsigned();
            $table->integer('region_id')->unsigned();
            $table->integer('audience_id')->unsigned();
            $table->integer('type_id')->unsigned();
            $table->integer('size_id')->unsigned();
            $table->string('name');
            $table->boolean('active')->default(TRUE);
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('partner_id')->references('id')->on('partners');
            $table->foreign('campaign_id')->references('id')->on('campaigns');
            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('region_id')->references('id')->on('regions');
            $table->foreign('audience_id')->references('id')->on('audiences');
            $table->foreign('type_id')->references('id')->on('delivery_types');
            $table->foreign('size_id')->references('id')->on('delivery_sizes');
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
        Schema::dropIfExists('deliveries');
    }
}
