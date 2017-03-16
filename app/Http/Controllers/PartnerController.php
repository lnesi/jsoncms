<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CrudApiController;
use App\Partner;
class PartnerController extends CrudAjaxController
{
    protected $modelClass=Partner::class;
}
