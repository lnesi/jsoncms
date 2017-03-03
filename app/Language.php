<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    //
    protected $table="languages";
    public $timestamps = false;

    public static function getByCode($language_code){
      $language_code=strtolower($language_code);
    	return Language::where(['code'=>$language_code])->first();
    }
}
