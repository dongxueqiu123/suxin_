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

Route::get('{locale}', 'HomeController@index');

Route::redirect('/', '/'.app()->getLocale(), 301);
Route::prefix('{locale}')->group(function () {

    // ==== auth routes
    Route::get('login', 'Auth\LoginController@showLoginForm');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout');

    Route::get('register', 'Auth\RegisterController@showRegistrationForm');
    Route::post('register', 'Auth\RegisterController@register');

    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');

    // === account routes
    Route::get('account', 'AccountController@index');

    // === admin routes
    Route::get('admin', 'AdminController@index');

    // ==== public routes
    Route::get('sensors', 'HomeController@sensors');
    Route::get('connectivity', 'HomeController@connectivity');
    Route::get('cloud', 'HomeController@industrial');
    Route::get('analytics', 'HomeController@analytics');
    Route::get('contact_us', 'HomeController@contact_us');

});

Route::get('admin', 'Admin\HomeController@index');
Route::get('admin/permission', 'Admin\HomeController@permission');

Route::group(['prefix' => 'admin/companies', 'middleware' =>['RolePermission']], function () {
    Route::get('/', 'Admin\CompaniesController@index')->name('companies');
    Route::get('/store', 'Admin\CompaniesController@store')->name('companies.store');
    Route::get('/edit/{id}', 'Admin\CompaniesController@edit')->name('companies.edit');
});

Route::group(['prefix' => 'admin/users', 'middleware' =>['RolePermission']],function(){
    Route::get('/', 'Admin\UsersController@index')->name('users');
    Route::get('/store', 'Admin\UsersController@store')->name('users.store');
    Route::get('/edit/{id}', 'Admin\UsersController@edit')->name('users.edit');
});

Route::group(['prefix' => 'admin/roles', 'middleware' =>['RolePermission']],function(){
    Route::get('/', 'Admin\RolesController@index')->name('roles');
    Route::get('/store', 'Admin\RolesController@store')->name('roles.store');
    Route::get('/edit/{id}', 'Admin\RolesController@edit')->name('roles.edit');
});

Route::group(['prefix' => 'admin/permissions', 'middleware' =>['RolePermission']],function(){
    Route::get('/', 'Admin\PermissionsController@index')->name('permissions');
    Route::get('/store', 'Admin\PermissionsController@store')->name('permissions.store');
    Route::get('/edit/{id}', 'Admin\PermissionsController@edit')->name('permissions.edit');
});

/**测试权限**/
Route::group(['prefix' => 'admin/test11', 'middleware' =>['RolePermission']],function(){
    Route::get('/', 'Admin\homeController@test11')->name('test11');
});
Route::group(['prefix' => 'admin/test12', 'middleware' =>['RolePermission']],function(){
    Route::get('/', 'Admin\homeController@test12')->name('test12');
});
Route::group(['prefix' => 'admin/test2', 'middleware' =>['RolePermission']],function(){
    Route::get('/', 'Admin\homeController@test2')->name('test2');
});
//Route::get('admin/companies', 'Admin\CompaniesController@index');