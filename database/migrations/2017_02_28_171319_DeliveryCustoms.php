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
            $table->string('default_value')->nullable();
            $table->text('data')->nullable();
            $table->text('help_text')->nullable();
            $table->boolean('active')->default(TRUE);
            $table->integer('sort_index')->unsigned()->default(0);
            $table->timestamps();
            $table->foreign('delivery_id')->references('id')->on('deliveries');
            $table->foreign('component_id')->references('id')->on('components');
            $table->unique(['key', 'delivery_id']);
        });

        Schema::table('delivery_customs',function(Blueprint $table){
            
            $sql='CREATE TRIGGER bi_delivery_customs BEFORE INSERT ON delivery_customs FOR EACH ROW
                  BEGIN
                  SET NEW.sort_index=(SELECT count(*)+1 FROM delivery_customs where delivery_id=NEW.delivery_id and deleted_at is null);
                  END;';
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
        Schema::dropIfExists('delivery_customs');
    }
}
