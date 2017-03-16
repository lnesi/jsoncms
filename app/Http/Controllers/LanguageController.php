<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CrudApiController;
use App\Language;
class LanguageController extends CrudAjaxController
{
    //
    protected $modelClass=Language::class;
}
