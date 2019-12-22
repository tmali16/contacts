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

Route::get('/', 'IndexController@index')->name('index');

Route::get('/glava', 'AdminController@index')->name('admin_index');

Route::get('/store/new', 'IndexController@create')->name('create_gu');
Route::get('/store/upr', 'IndexController@createUpr');
