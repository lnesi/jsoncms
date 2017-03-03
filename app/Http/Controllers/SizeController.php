<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CrudApiController;
use App\BannerSize;
class SizeController extends CrudApiController
{
    protected $modelClass=BannerSize::class;
}
