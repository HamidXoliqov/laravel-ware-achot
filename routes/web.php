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

Auth::routes();

Route::get('/admin','backend\AdminController@loginForm')->name('admin');
Route::get('/signup','backend\AdminController@signupForm')->name('signup');
Route::post('/logadmin', 'backend\AdminController@login');
Route::post('/signup', 'backend\AdminController@signup');


Route::group(['middleware' => 'admin'], function () {

	Route::get('/', 'backend\AdminController@dashboard')->name('dashboard');
	Route::get('/home', 'backend\AdminController@dashboard')->name('dashboard');
	Route::get('/dashboard','backend\AdminController@dashboard')->name('dashboard');

    Route::resource('/user','backend\UserController');
    Route::get('/user/status/{id}','backend\UserController@status');

	Route::get('/user-search', 'backend\AdminController@search')->name('user-search');


	Route::resource('/ware','backend\WareController');
	Route::get('/ware/status/{id}','backend\WareController@status');

	Route::get('/ware-search', 'backend\WareController@search')->name('ware-search');

	Route::resource('/product','backend\ProductController');
	Route::get('/product-search', 'backend\ProductController@search')->name('product-search');

	Route::resource('/ware-item','backend\WareItemController');

	Route::get('/ware-item-search', 'backend\WareItemController@search')->name('ware-item-search');

	Route::resource('/ware-process','backend\WareProcessController');
    Route::get('/ware-process-count-plus','backend\WareProcessController@countplus')->name('ware-process-count-plus');
    Route::get('/ware-process-count-minus','backend\WareProcessController@countminus')->name('ware-process-count-minus');

	Route::get('/ware-process-search', 'backend\WareProcessController@search')->name('ware-process-search');

	Route::resource('/ware-completed','backend\WareCompletedController');
	Route::get('/ware-completed-search', 'backend\WareCompletedController@search')->name('ware-completed-search');

	Route::resource('/report','backend\WareReportController');


	Route::get('/admin-search', 'backend\AdminController@search')->name('admin-search');

	Route::get('/users/profile/{id}',['as'=> 'profile','uses'=>'backend\UserController@profile']);

});
Route::get('{slug}', 'frontend\StandardController@index')->where('slug', '[A-Za-z0-9_\-]+');
