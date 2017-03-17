<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class ReadAjaxController extends Controller{
	protected $modelClass;
   
   /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(){
      $baseQuery=call_user_func($this->modelClass."::query");

      if(isset($_GET['filter']) && trim($_GET['filter'])!=""){
        $filters=$this->parseFilter($_GET['filter']);
        foreach($filters as $filter){
          $baseQuery=$baseQuery->where($filter[0],$filter[1]);
        }
      }

      if(isset($_GET['orderby']) && trim($_GET['orderby'])!=""){
           $direction="asc";
           if(isset($_GET['direction']) && $_GET['direction']=="desc"){
              $direction="desc";
           }
           $baseQuery->orderBy($_GET['orderby'],$direction);
      }

      if(isset($_GET['paginate']) && $_GET['paginate']=="false"){
          $result=$baseQuery->get();
      }else{
          $result=$baseQuery->paginate();
      }    
      return $result;
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id){
      return call_user_func($this->modelClass."::findOrFail",$id);
  }

  
  protected function parseFilter($filterString){
      $filtersGroup=explode(":",$filterString);
      $filters=[];
      foreach($filtersGroup as $f){
            $filters[]=explode(",",$f);
      }
      return $filters;
  }
}
