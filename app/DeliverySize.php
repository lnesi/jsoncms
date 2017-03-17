<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliverySize extends Model
{
    //
    protected $table = 'delivery_sizes';
    public $timestamps = false;
    
    // Mutator for name
    public function getNameAttribute($value){
    	return $value." (".$this->width."x".$this->height.")";
    }
}
