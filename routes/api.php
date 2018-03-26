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