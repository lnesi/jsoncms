<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CrudApiController;
use App\Partner;
class PartnerController extends CrudApiController
{
    protected $modelClass=Partner::class;
}
