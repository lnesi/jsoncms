<?php

use Illuminate\Http\Request;
use App\Http\Controllers;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('partners', PartnerController::class,['except' => ['create', 'edit']]);
Route::resource('audiences', AudienceController::class,['except' => ['create', 'edit']]);
Route::resource('regions', RegionController::class,['except' => ['create', 'edit']]);
Route::resource('campaings', CampaignController::class,['except' => ['create', 'edit']]);
Route::resource('banners', BannerController::class,['except' => ['create', 'edit']]);
//Read Only Resources
Route::resource('sizes', SizeController::class,['only' => [ 'index','show']]);
Route::resource('types', TypeController::class,['only' => [ 'index','show']]);
Route::resource('components', ComponentController::class,['only' => [ 'index','show']]);
Route::resource('countries', CountryController::class,['only' => [ 'index','show']]);
Route::resource('languages', LanguageController::class,['only' => [ 'index','show']]);

Route::get('regions/{id}/remove/{country_id}', 'RegionController@removeCountry');
Route::get('regions/{id}/add/{country_id}', 'RegionController@addCountry');