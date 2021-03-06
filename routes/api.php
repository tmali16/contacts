<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/gu', 'IndexController@getGu');
Route::get('/getgu', 'IndexController@returnGu');
Route::get('/phone', 'IndexController@getPhone');
Route::get('/search', 'IndexController@search');
Route::get('/dolj', 'IndexController@getdolj');
Route::get('/getone', 'AdminController@getOne');
Route::POST('/put', 'AdminController@addPersona');
Route::get('/addphone', 'AdminController@addPhone');

// get uprav or otdel with gu id
Route::get('/uprotd', 'IndexController@getUprOtd');