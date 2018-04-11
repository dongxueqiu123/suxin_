<?php

use Illuminate\Http\Request;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(['prefix' => 'admin/companies'], function () {
    Route::post('/edit/{id}', 'Api\CompaniesController@edit')->name('api.companies.edit');
    //Route::get('/edit/{id}', 'Api\CompaniesController@edit')
    Route::post('/store', 'Api\CompaniesController@store')->name('api.companies.store');
    Route::post('/delete/{id}', 'Api\CompaniesController@delete')->name('api.companies.delete');
});

Route::group(['prefix' => 'admin/users'], function () {
    Route::post('/edit/{id}', 'Api\UsersController@edit')->name('api.users.edit');
    //Route::get('/edit/{id}', 'Api\CompaniesController@edit')
    Route::post('/store', 'Api\UsersController@store')->name('api.users.store');
    Route::post('/delete/{id}', 'Api\UsersController@delete')->name('api.users.delete');
});

Route::group(['prefix' => 'admin/roles'], function () {
    Route::post('/edit/{id}', 'Api\RolesController@edit')->name('api.roles.edit');
    //Route::get('/edit/{id}', 'Api\CompaniesController@edit')
    Route::post('/store', 'Api\RolesController@store')->name('api.roles.store');
    Route::post('/delete/{id}', 'Api\RolesController@delete')->name('api.roles.delete');
});

Route::group(['prefix' => 'admin/permissions'], function () {
    Route::post('/edit/{id}', 'Api\PermissionsController@edit')->name('api.permissions.edit');
    //Route::get('/edit/{id}', 'Api\CompaniesController@edit')
    Route::post('/store', 'Api\PermissionsController@store')->name('api.permissions.store');
    Route::post('/delete/{id}', 'Api\PermissionsController@delete')->name('api.permissions.delete');
});

Route::group(['prefix' => 'admin/equipments'], function () {
    Route::post('/edit/{id}', 'Api\EquipmentsController@edit')->name('api.equipments.edit');
    Route::post('/getEquipments', 'Api\EquipmentsController@getEquipments')->name('api.equipments.getEquipments');
    Route::post('/store', 'Api\EquipmentsController@store')->name('api.equipments.store');
    Route::post('/delete/{id}', 'Api\EquipmentsController@delete')->name('api.equipments.delete');
});

Route::group(['prefix' => 'admin/collectors'], function () {
    Route::post('/edit/{id}', 'Api\CollectorsController@edit')->name('api.collectors.edit');
    Route::post('/getCollectors', 'Api\CollectorsController@getCollectors')->name('api.collectors.getCollectors');
    Route::post('/store', 'Api\CollectorsController@store')->name('api.collectors.store');
    Route::post('/delete/{id}', 'Api\CollectorsController@delete')->name('api.collectors.delete');
});

Route::group(['prefix' => 'admin/thresholds'], function () {
    Route::post('/edit/{id}', 'Api\ThresholdsController@edit')->name('api.thresholds.edit');
    Route::post('/getPatterns', 'Api\ThresholdsController@getPatterns');
    Route::post('/store', 'Api\ThresholdsController@store')->name('api.thresholds.store');
    Route::post('/delete/{id}', 'Api\ThresholdsController@delete')->name('api.thresholds.delete');
});

Route::group(['prefix' => 'admin/liaisons'], function () {
    Route::post('/edit/{id}', 'Api\LiaisonsController@edit')->name('api.liaisons.edit');
    Route::post('/store', 'Api\LiaisonsController@store')->name('api.liaisons.store');
    Route::post('/delete/{id}', 'Api\LiaisonsController@delete')->name('api.liaisons.delete');
});

Route::group(['prefix' => 'admin/alarms'], function () {
    Route::post('/edit/{id}', 'Api\AlarmsController@edit')->name('api.alarms.edit');
});