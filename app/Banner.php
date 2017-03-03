<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Observers\BannerObserver;
class Banner extends Model
{
    //
    use SoftDeletes;
    protected $table = 'banners';
    protected $dates = ['deleted_at','created_at','updated_at','published_at'];
    protected $fillable=['name'];

    public static function boot(){
      parent::boot();
      Banner::observe(new BannerObserver());
    }

    public function partner(){
    	return $this->belongsTo(Partner::class);
    }
    public function size(){
    	return $this->belongsTo(BannerSize::class,'size_id');
    }

    public function status(){
    	return $this->belongsTo(Status::class);
    }

    public function type(){
    	return $this->belongsTo(BannerType::class,'type_id');
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
        return $this->hasMany(BannerCustom::class);
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
