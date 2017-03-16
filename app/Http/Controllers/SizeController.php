<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CrudApiController;
use App\DeliverySize;
class SizeController extends CrudAjaxController
{
    protected $modelClass=DeliverySize::class;
}
