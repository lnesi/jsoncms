<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class CrudAjaxController extends Controller{

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
          $result=$baseQuery->paginate(1);
      }    
      return $result;
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request){
      $item=call_user_func($this->modelClass."::create",$request->input());
      return $item;
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

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id){
    $item=call_user_func($this->modelClass."::findOrFail",$id);
    $item->fill($request->input());
    $item->save();
    return $item;
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id){
    $item=call_user_func($this->modelClass."::findOrFail",$id);
    $item->delete();
    $response=['message'=>'ok'];
    return $response;
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
