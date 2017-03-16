<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CrudApiController;
use App\BannerType;
class TypeController extends CrudAjaxController
{
    protected $modelClass=BannerType::class;
}
