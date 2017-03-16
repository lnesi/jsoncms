<?php namespace App\Observers;

class DeliveryObserver{

  public function saved($delivery){
    $defaultContent=new \App\ContentSet(['name'=>'Default','rotation'=>100]);
    $defaultContent->delivery()->associate($delivery);
    $defaultContent->save();
  }

}
