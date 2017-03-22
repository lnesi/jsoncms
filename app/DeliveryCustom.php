<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class DeliveryCustom extends Model
{
    //
    
    protected $table = 'delivery_customs';
    protected $dates = ['created_at','updated_at'];
    protected $fillable=['delivery_id','component_id','name','key','data','help_text'];
    protected $with=['component'];
    protected $hidden=['delivery_id','component_id'];
    public function delivery(){
    	return $this->belongsTo(Delivery::class);
    }

    public function component(){
    	return $this->belongsTo(Component::class);
    }
}
