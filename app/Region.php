<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Region extends Model
{
    //
    use SoftDeletes;
    protected $table = 'regions';
    protected $dates = ['deleted_at','created_at','updated_at'];
    protected $fillable = ['name','abbr','partner_id'];
    protected $with=['partner','countries'];
    protected $hidden=['partner_id'];
    public function partner(){
    	return $this->belongsTo(Partner::class);
    }

    public function countries(){
    	return $this->belongsToMany(Country::class,'country_region','region_id','country_id');
    }

    public function addCountry($country_code){
        $country=Country::where(['code'=>$country_code])->first();
        if($country){
            $this->countries()->attach($country);
            return TRUE;
        }
        return FALSE;
    }
}
