<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'FrontController@index');
Route::group(['prefix' => 'ajax','middleware' => 'auth'], function () {
	Route::get('user', function (Request $request) {
	    return Auth::user();
	});
	Route::resource('partners', PartnerController::class,['except' => ['create', 'edit']]);
	Route::resource('audiences', AudienceController::class,['except' => ['create', 'edit']]);
	Route::resource('regions', RegionController::class,['except' => ['create', 'edit']]);
	Route::resource('campaigns', CampaignController::class,['except' => ['create', 'edit']]);
	Route::resource('deliveries', DeliveryController::class,['except' => ['create', 'edit']]);
	Route::resource('customs', DeliveryCustomController::class,['except' => ['create', 'edit']]);
	
	//Read Only Resources
	Route::resource('sizes', SizeController::class,['only' => [ 'index','show']]);
	Route::resource('types', TypeController::class,['only' => [ 'index','show']]);
	Route::resource('components', ComponentController::class,['only' => [ 'index','show']]);
	Route::resource('countries', CountryController::class,['only' => [ 'index','show']]);
	Route::resource('languages', LanguageController::class,['only' => [ 'index','show']]);

	Route::get('regions/{id}/remove/{country_id}', 'RegionController@removeCountry');
	Route::get('regions/{id}/add/{country_id}', 'RegionController@addCountry');

	
});


Auth::routes();


