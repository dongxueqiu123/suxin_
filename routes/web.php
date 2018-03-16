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