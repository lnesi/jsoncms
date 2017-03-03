<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Partner extends Model
{
    //
    use SoftDeletes;
    protected $table = 'partners';
    protected $dates = ['deleted_at','created_at','updated_at'];
    protected $fillable = ['name','abbr'];
}
