<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CrudApiController;
use App\Language;
class LanguageController extends CrudApiController
{
    //
    protected $modelClass=Language::class;
}
