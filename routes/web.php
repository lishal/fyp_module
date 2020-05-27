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
Route::get('/companies/edit/{id?}','CompanyController@edit');
Route::post('/companies/save', 'CompanyController@save');
Route::get('/companies/delete/{id}','CompanyController@delete');
Route::post('/filtercompanies', 'CompanyController@index');

Route::get('/Settings/fiscalyears','SettingsController@fiscalyears');
Route::get('Settings/fiscalyear/edit/{id?}','SettingsController@fiscalyearedit');
Route::post('Settings/fiscalyear/save', 'SettingsController@fiscalyearsave');
Route::get('Settings/fiscalyear/delete/{id}', 'SettingsController@fiscalyeardelete');

Route::get('/records/{id}/{fiscalyearId}', 'RecordsController@show');
Route::post('records/store', 'RecordsController@store');
Route::post('records/edittotal', 'RecordsController@updateTotal');
Route::post('/records/dateselection','RecordsController@display');


Route::get('admin/trialbalance/{fiscalyearid?}', 'TrialbalanceController@index');
Route::post('admin/trialbalance/store', 'TrialbalanceController@store');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('admin/trading/{fiscal_year?}', 'TradingController@index');
Route::post('admin/trading/store', 'TradingController@store');
Route::get('admin/profitloss', 'ProfitlossController@index');
Route::post('admin/trading/store', 'TradingController@store');

Route::get('admin/pdf/print', 'PdfController@index');
Route::post('admin/pdf/getneratePDF', 'PdfController@generatePDF');