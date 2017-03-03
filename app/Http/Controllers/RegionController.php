<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CrudApiController;
use App\Region;
class RegionController extends CrudApiController
{
    //
    protected $modelClass=Region::class;
}
