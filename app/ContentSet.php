<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContentSet extends Model
{
    //
    use SoftDeletes;
    protected $table = 'banner_sets';
    protected $dates = ['deleted_at','created_at','updated_at','published_at'];
    protected $fillable=['name','rotation'];
    public function banner(){
    	return $this->belongsTo(Banner::class,'banner_id');
    }

    public function status(){
    	return $this->hasOne(Status::class,'status_id');
    }
}
