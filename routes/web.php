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

Route::get('/', function () {
    return view('welcome');
});
Route::post('regcustomer', 'UserController@check');
Route::get('/registersp', function () {
    if(session()->has('sp-login'))
    {
        return view('makecus');
    }
    else
    {
        return view('register');
    }
});
Route::group(['middleware'=>['CustomAuth']],function()
 {  
    Route::view('addnew','addnew');
    Route::post('savenew','UserController@addnew');
    Route::get('sp_logout','UserController@sp_logout');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/spadmin', function () {
    if(session()->has('ad-login'))
    {
        return redirect()->route('admindash');
    }
    else
    {
        return view('spadmin');
    }
});
Route::group(['middleware'=>['AdminAuth']],function()
 {  
    Route::get('ad_delete/{id}','UserController@ad_delete');
    Route::get('ad_edit/{id}','UserController@ad_edit');
    Route::get('changest/{id}','UserController@changeState');
    Route::name('admindash')->get('admindash','UserController@checkagain');
    Route::get('ad_logout','UserController@ad_logout');
});
Route::post('spadmindashboard','UserController@spadmindash');
Route::post('/getcus','HomeController@getcus');
Route::post('getderive','HomeController@getderive');
Route::post('/makereq','HomeController@makereq');
Route::post('/admindashboard','UserController@checkadmin');
Route::group(['middleware'=>['Admin']],function()
 {  
    Route::name('admindashboard')->get('admindashboard','UserController@reloadstats');
    Route::get('adminlogout','UserController@adminlogout');
    Route::get('adminlogout','UserController@adminlogout');
    Route::get('accept/{id}','UserController@accept');
    Route::get('deny/{id}','UserController@deny');
    Route::get('getdirect/{lats1}/{long1}', 'UserController@getdirectfunc');
    
});
Route::get('/admin', function () {
    $message = NULL;
    if(session()->has('admin'))
    {
        return redirect()->route('admindashboard');
    }
    else
    {
        return view('admin',["message"=>$message]);
    }
});
Route::get('confirmyes/{id}', 'HomeController@confirmyesfunc');
Route::get('confirmno/{id}', 'HomeController@confirmnofunc');
