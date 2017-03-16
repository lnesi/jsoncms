<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CrudApiController;
use App\BannerSize;
class SizeController extends CrudAjaxController
{
    protected $modelClass=BannerSize::class;
}
