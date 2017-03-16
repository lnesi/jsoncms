<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CrudApiController;
use App\Component;

class ComponentController extends CrudAjaxController
{
   protected $modelClass=Component::class;
}
