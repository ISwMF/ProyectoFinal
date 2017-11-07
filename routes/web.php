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

Route::get('login/facebook', 'TestController@redirectToProvider')->name('facebook.login');
Route::get('login/facebook/callback', 'TestController@handleProviderCallback');

//Route::get('ajaxRequest', 'TestController@ajaxRequest');

Route::post('ajaxRequest', 'TestController@ajaxRequestPost');
Route::post('ajaxRequest2', 'TestController@ajaxRequestPost2');
//Route::resource('ajaxRequest', 'TestController', ['except' => ['create']]);

Route::get('/', [
  'uses' => 'TestController@view',
  'as'   => 'userView'
])->name('house');

Route::get('news/{id}', [
  'uses' => 'TestController@reportView',
  'as'   => 'userView'
]);
Route::get('newpost', [
  'uses' => 'TestController@newpostView',
  'as'   => 'userView'
]);
Route::post('reportAuth', [
  'uses' => 'TestController@reportAuthView',
  'as'   => 'userView'
]);
Route::get('exit',[
  'uses' => 'TestController@exitView',
  'as'   => 'userView'
]);
Route::post('userAuth',[
  'uses' => 'TestController@authView',
  'as'   => 'userView'
]);
Route::post('userSignIn',[
  'uses' => 'TestController@signin',
  'as'   => 'userView'
]);


Route::get('log',[
  'uses' => 'TestController@loginView',
  'as'   => 'userView'
]);
Route::get('reg',[
  'uses' => 'TestController@registerView',
  'as'   => 'userView'
]);
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
