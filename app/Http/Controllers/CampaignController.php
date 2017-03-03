<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CrudApiController;
use App\Campaign;
class CampaignController extends CrudApiController
{
    //
     protected $modelClass=Campaign::class;
}
