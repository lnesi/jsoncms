<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CrudApiController;
use App\Country;
class CountryController extends CrudApiController
{
    //
    protected $modelClass=Country::class;
}
