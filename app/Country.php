<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    //
    protected $table = 'countries';
    public $timestamps = false;

    public static function getByCode($country_code){
      $country_code=strtoupper($country_code);
    	return Country::where(['code'=>$country_code])->first();
    }
}
