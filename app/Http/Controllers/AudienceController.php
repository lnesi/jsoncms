<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CrudApiController;
use App\Audience;
class AudienceController extends CrudAjaxController
{
  protected $modelClass=\App\Audience::class;
}
