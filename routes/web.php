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

Route::get('/', function () {
    return view('Auth/login');
});

Auth::routes();

Route::get('/profile','UserController@profile');
Route::POST('/profile', 'UserController@update_profile');
Route::POST('/update_password', 'UserController@update_password');

Route::get('/type','TypeController@index');
Route::get('/type/edit/{id?}','TypeController@edit');
Route::get('/type/delete/{id?}','TypeController@delete');
Route::POST('/type/save','TypeController@save');

Route::get('/companies','CompanyController@index');
Route::get('/companies/edit','CompanyController@edit');
Route::post('/companies/save', 'CompanyController@save');

Route::get('/Settings/fiscalyears','SettingsController@fiscalyears');
Route::get('/settings/fiscalyear/edit','SettingsController@edit');
Route::post('/settings/fiscalyear/save', 'SettingsController@fiscalyearsave');
Route::get('fiscalyear/delete/{id}', 'SettingsController@fiscalyeardelete');


Route::get('/home', 'HomeController@index')->name('home');

