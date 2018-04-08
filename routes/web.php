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


Auth::routes();

Route::get('/home', 'AdminController@index')->middleware('auth');
Route::get('/users', 'AdminController@users')->middleware('auth');
Route::get('/category', 'AdminController@category')->middleware('auth');
Route::get('/item', 'AdminController@item')->middleware('auth');
Route::get('/comment', 'AdminController@comment')->middleware('auth');


Route::get('/edit', 'AdminController@edit')->middleware('auth');
Route::post('/edit', 'AdminController@editPost')->middleware('auth');

Route::get('/add','AdminController@add')->middleware('auth');
Route::post('/add','AdminController@add')->middleware('auth');

Route::get('/profile','AdminController@profile')->middleware('auth');



/*******************************Users Route**************************************** */
Route::get('/','HomeController@index');
Route::get('/view/{id}','HomeController@view');
Route::get('/category/{id}','HomeController@category');
Route::get('/profile/{id}','HomeController@profile')->middleware('auth');
Route::get('/new','HomeController@newads')->middleware('auth');
Route::post('/newads','HomeController@addads')->middleware('auth');

Route::get('/search','AjaxController@search');
Route::get('/message','AjaxController@message');
Route::post('/message','AjaxController@messages');



