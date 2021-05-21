<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/', 'Auth\NewLoginController@index');
Route::get('/register', 'Auth\NewRegisterController@index')->name('register');
Route::get('/forgot', 'Auth\NewForgotController@index')->name('forgot');

Route::post('/register', 'Auth\NewRegisterController@register');
Route::post('/login', 'Auth\NewLoginController@login');
Route::get('/logout', 'Auth\NewLoginController@logout');

Route::group(['middleware' => 'UserInfoMiddleware'], function () {
  Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
  Route::get('/domain', 'DomainController@index')->name('domain');
  Route::get('/domains', 'DNSController@index')->name('domains');
  Route::post('/dnsgetdefault', 'DNSController@dnsgetdefault');
  Route::post('/detail-domaininfo', 'DomainController@domaindetailinfo');
  Route::post('/dns-record', 'DNSController@dnsrecord');
  Route::post('/add-domain-manually', 'DomainController@adddomainmanually');
  Route::post('/remove-domain', 'DomainController@removedomain');
  Route::post('/all-remove-domain', 'DomainController@allremovedomain');
});
