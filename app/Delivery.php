<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Observers\DeliveryObserver;
class Delivery extends Model
{
    //
    use SoftDeletes;
    protected $table = 'deliveries';
    protected $dates = ['deleted_at','created_at','updated_at','published_at'];
    protected $fillable=['name','partner_id','campaign_id','audience_id','country_id','language_id','region_id','size_id','type_id'];
    protected $with=['status','type','partner','campaign','country','region','language','size','audience'];
    protected $hidden=['partner_id','country_id','region_id','language_id','size_id','audience_id','status_id','type_id','campaign_id'];
    public static function boot(){
      parent::boot();
      Delivery::observe(new DeliveryObserver());
    }

    public function partner(){
    	return $this->belongsTo(Partner::class);
    }
    
    public function campaign(){
        return $this->belongsTo(Campaign::class);
    }

    public function size(){
    	return $this->belongsTo(DeliverySize::class,'size_id');
    }

    public function status(){
    	return $this->belongsTo(Status::class);
    }

    public function type(){
    	return $this->belongsTo(DeliveryType::class,'type_id');
    }

    public function audience(){
    	return $this->belongsTo(Audience::class);
    }

    public function region(){
    	return $this->belongsTo(Region::class);
    }

    public function country(){
    	return $this->belongsTo(Country::class);
    }

    public function language(){
      return $this->belongsTo(Language::class);
    }
    public function customs(){
        return $this->hasMany(DeliveryCustom::class);
    }

    public function contentSets(){
        return $this->hasMany(ContentSet::class);
    }

    public function setCountry($country_code){
      $country=Country::getByCode($country_code);
      if($country){
        $this->country()->associate($country);
        return TRUE;
      }
      return FALSE;
    }

    public function setLanguage($language_code){
      $language=Language::getByCode($language_code);
      if($language){
        $this->language()->associate($language);
        return TRUE;
      }
      return FALSE;
    }
}
