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
    Route::get('account', 'HomeController@index');

    // === admin routes
    Route::get('admin', 'AdminController@index');

    // ==== public routes
    Route::get('sensors', 'HomeController@sensors');
    Route::get('connectivity', 'HomeController@connectivity');
    Route::get('cloud', 'HomeController@industrial');
    Route::get('analytics', 'HomeController@analytics');
    Route::get('contact_us', 'HomeController@contact_us');

});

Route::post('admin/users/login', 'HomeController@login');

//Route::get('admin/login', 'Admin\HomeController@login');

Route::get('admin', 'Admin\HomeController@index')->name('admin');
Route::get('admin/permission', 'Admin\HomeController@permission');

Route::group(['prefix' => 'admin/companies', 'middleware' =>['auth.user','RolePermission']], function () {
    Route::get('/', 'Admin\CompaniesController@index')->name('companies');
    Route::get('/store', 'Admin\CompaniesController@store')->name('companies.store');
    Route::get('/edit/{id}', 'Admin\CompaniesController@edit')->name('companies.edit');
});

Route::group(['prefix' => 'admin/users', 'middleware' =>['auth.user','RolePermission']],function(){
    Route::get('/', 'Admin\UsersController@index')->name('users');
    Route::get('/store', 'Admin\UsersController@store')->name('users.store');
    Route::get('/edit/{id}', 'Admin\UsersController@edit')->name('users.edit');
});

Route::group(['prefix' => 'admin/roles', 'middleware' =>['auth.user','RolePermission']],function(){
    Route::get('/', 'Admin\RolesController@index')->name('roles');
    Route::get('/store', 'Admin\RolesController@store')->name('roles.store');
    Route::get('/edit/{id}', 'Admin\RolesController@edit')->name('roles.edit');
});

Route::group(['prefix' => 'admin/permissions', 'middleware' =>['auth.user','RolePermission']],function(){
    Route::get('/', 'Admin\PermissionsController@index')->name('permissions');
    Route::get('/store', 'Admin\PermissionsController@store')->name('permissions.store');
    Route::get('/edit/{id}', 'Admin\PermissionsController@edit')->name('permissions.edit');
});

Route::group(['prefix' => 'admin/equipments', 'middleware' =>['auth.user','RolePermission']],function(){
    Route::get('/', 'Admin\EquipmentsController@index')->name('equipments');
    Route::get('/store', 'Admin\EquipmentsController@store')->name('equipments.store');
    Route::get('/edit/{id}', 'Admin\EquipmentsController@edit')->name('equipments.edit');
});

Route::group(['prefix' => 'admin/collectors', 'middleware' =>['auth.user','RolePermission']],function(){
    Route::get('/', 'Admin\CollectorsController@index')->name('collectors');
    Route::get('/store', 'Admin\CollectorsController@store')->name('collectors.store');
    Route::get('/edit/{id}', 'Admin\CollectorsController@edit')->name('collectors.edit');
});

Route::group(['prefix' => 'admin/thresholds', 'middleware' =>['auth.user','RolePermission']],function(){
    Route::get('/', 'Admin\ThresholdsController@index')->name('thresholds');
    Route::get('/store', 'Admin\ThresholdsController@store')->name('thresholds.store');
    Route::get('/edit/{id}', 'Admin\ThresholdsController@edit')->name('thresholds.edit');
});

Route::group(['prefix' => 'admin/liaisons', 'middleware' =>['auth.user','RolePermission']],function(){
    Route::get('/', 'Admin\LiaisonsController@index')->name('liaisons');
    Route::get('/store', 'Admin\LiaisonsController@store')->name('liaisons.store');
    Route::get('/edit/{id}', 'Admin\LiaisonsController@edit')->name('liaisons.edit');
});


Route::group(['prefix' => 'admin/alarms', 'middleware' =>['auth.user','RolePermission']],function(){
    Route::get('/', 'Admin\AlarmsController@index')->name('alarms');
});

Route::group(['prefix' => 'admin/charts', 'middleware' =>['auth.user','RolePermission']],function(){
    Route::get('/collectorChart/{id}', 'Admin\ChartsController@collectorChart')->name('charts.collectorChart');
    Route::get('/collectorChartRealTime/{id}', 'Admin\ChartsController@collectorChartRealTime')->name('charts.collectorChartRealTime');
    Route::get('/collectorResponse', 'Admin\ChartsController@collectorResponse')->name('collectorResponse');
});

Route::group(['prefix' => 'admin/intelligent', 'middleware' =>['auth.user','RolePermission']],function(){
    Route::get('/', 'Admin\IntelligentsController@index')->name('intelligents');

});

Route::group(['prefix' => 'admin/products', 'middleware' =>['auth.user','RolePermission']],function(){
    Route::get('/', 'Admin\ProductsController@index')->name('products');
    Route::get('/store', 'Admin\ProductsController@store')->name('products.store');
    Route::get('/edit/{id}', 'Admin\ProductsController@edit')->name('products.edit');

});

Route::group(['prefix' => 'admin/buyProducts', 'middleware' =>['auth.user','RolePermission']],function(){
    Route::get('/buy', 'Admin\ProductsController@buy')->name('buyProducts.buy');
    Route::get('/show/{id}', 'Admin\ProductsController@show')->name('buyProducts.show');
});


Route::group(['prefix' => 'admin/carts', 'middleware' =>['auth.user','RolePermission']],function(){
    Route::get('/', 'Admin\CartsController@index')->name('carts');
});

Route::group(['prefix' => 'admin/orders', 'middleware' =>['auth.user','RolePermission']],function(){
    Route::get('/', 'Admin\OrdersController@index')->name('orders');
    Route::get('/show/{orderNo}', 'Admin\OrdersController@show')->name('orders.show');
    Route::get('/info/{orderNo}', 'Admin\OrdersController@info')->name('orders.info');
});

Route::group(['prefix' => 'admin/pay'],function(){
    Route::get('/alipay/{orderNo}', 'Admin\PayController@index')->name('pay.alipay');
    Route::get('/return', 'Admin\PayController@return')->name('pay.return');
    Route::post('/notify', 'Admin\PayController@notify')->name('pay.notify');
});

/**测试权限**/
Route::group(['prefix' => 'admin/test11', 'middleware' =>['auth.user','RolePermission']],function(){
    Route::get('/', 'Admin\HomeController@test11')->name('test11');
});
Route::group(['prefix' => 'admin/test12', 'middleware' =>['auth.user','RolePermission']],function(){
    Route::get('/', 'Admin\HomeController@test12')->name('test12');
});
Route::group(['prefix' => 'admin/test2', 'middleware' =>['auth.user','RolePermission']],function(){
    Route::get('/', 'Admin\HomeController@test2')->name('test2');
});
//Route::get('admin/companies', 'Admin\CompaniesController@index');