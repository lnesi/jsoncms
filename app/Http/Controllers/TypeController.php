<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CrudApiController;
use App\DeliveryType;
class TypeController extends CrudAjaxController
{
    protected $modelClass=DeliveryType::class;
}
