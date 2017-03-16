<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeliveryCustom extends Model
{
    //
    use SoftDeletes;
    protected $table = 'delivery_customs';
    protected $dates = ['deleted_at','created_at','updated_at'];
    
    public function delivery(){
    	return $this->belongsTo(Delivery::class);
    }
}
