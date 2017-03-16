<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CrudApiController;
use App\Region;
use App\Country;
class RegionController extends CrudAjaxController
{
    //
    protected $modelClass=Region::class;

    public function removeCountry(Request $request,$id,$country_id){
    	$region=Region::findOrFail($id);
    	$country=Country::findOrFail($country_id);
    	$region->countries()->detach($country_id);
    	$region->load('countries');
    	$region->fresh();
    	return $region;
    }

    public function addCountry(Request $request,$id,$country_id){
    	$region=Region::findOrFail($id);
    	$country=Country::findOrFail($country_id);
    	if(!$region->countries->contains($country)){
    		$region->countries()->attach($country->id);
    		$region->load('countries');
    	}

    	$region->fresh();
    	return $region;
    }
}
