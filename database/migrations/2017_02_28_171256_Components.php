<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Components extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('components',function(Blueprint $table){
            $table->increments('id');
            $table->string('name',100);
            $table->string('tag',100);
        });

        Schema::table('components',function(Blueprint $table){
            $sql="INSERT INTO components(name,tag) VALUES('Plain Text','plain_text'),('HTML Text','html_text'),('Multiple Choice','multiple_choice'),('Checkbox','checkbox'),('Separator','separator'),('Panel Open','panel_open'),('Panel Close','panel_close');";
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
        Schema::dropIfExists('components');
    }
}
