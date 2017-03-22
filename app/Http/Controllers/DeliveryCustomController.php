<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CrudApiController;
use App\DeliveryCustom;
class DeliveryCustomController extends CrudAjaxController{
    //
     protected $modelClass=DeliveryCustom::class;
     
  //Override
  public function store(Request $request){
  	 $custom=new DeliveryCustom();
  	 $custom->fill($request->input());
  	 $custom->save();
     $custom->component;
     return $custom;
  }
     
      
}
