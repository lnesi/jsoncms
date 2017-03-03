<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Audience extends Model
{
    //
    use SoftDeletes;
    protected $table = 'audiences';
    protected $dates = ['deleted_at','created_at','updated_at'];
    protected $fillable = ['name','abbr','partner_id'];
    protected $with=['partner'];
    protected $hidden=['partner_id'];
    public function partner(){
    	return $this->belongsTo(Partner::class);
    }
}
