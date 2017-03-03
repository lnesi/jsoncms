<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixStatusDefaults extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('banners',function(Blueprint $table){
          $table->integer('status_id')->unsigned()->default(1)->after('audience_id');
          $table->foreign('status_id')->references('id')->on('status');
          $table->integer('type_id')->unsigned()->default(1)->change();
        });

        Schema::table('banner_sets',function(Blueprint $table){
          $table->integer('status_id')->unsigned()->default(1)->change();
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
    }
}
