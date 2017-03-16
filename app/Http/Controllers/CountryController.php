<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CrudApiController;
use App\Country;
class CountryController extends CrudAjaxController
{
    //
    protected $modelClass=Country::class;
}
