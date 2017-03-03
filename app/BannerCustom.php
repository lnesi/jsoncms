<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BannerCustom extends Model
{
    //
    use SoftDeletes;
    protected $table = 'banner_customs';
    protected $dates = ['deleted_at','created_at','updated_at'];
    
    public function banner(){
    	return $this->belongsTo(Banner::class);
    }
}
