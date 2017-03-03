<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CrudApiController;
use App\Component;

class ComponentController extends CrudApiController
{
   protected $modelClass=Component::class;
}
