<?php namespace App\Observers;

class BannerObserver{

  public function saved($banner){
    $defaultContent=new \App\ContentSet(['name'=>'Default','rotation'=>100]);
    $defaultContent->banner()->associate($banner);
    $defaultContent->save();
  }

}
