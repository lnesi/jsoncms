<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class CrudApiController extends Controller{

  protected $modelClass;
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(){
      return call_user_func($this->modelClass."::paginate");
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

}
