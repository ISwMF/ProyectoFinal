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

Route::get('login/facebook', 'UserController@redirectToProvider')->name('facebook.login');
Route::get('login/facebook/callback', 'UserController@handleProviderCallback');

Route::post('votereport', 'UserController@voteReport');
Route::post('votecomment', 'UserController@voteComment');
Route::post('sendcomment', 'UserController@addComment');

Route::post('addfavorite', 'UserController@addFavorite');
Route::post('removefavorite', 'UserController@removeFavorite');

Route::post('updateprofile', 'UserController@updateProfile');
Route::post('updatepassword', 'UserController@updatePassword');

Route::post('deleteReport', 'ReportController@deleteReport');

Route::post('deleteComment', 'UserController@deleteComment');

Route::get('/', [
  'uses' => 'HomeController@view',
  'as'   => 'userView'
])->name('house');

Route::get('profile/{id}/edit', [
  'uses' => 'UserController@viewEdit',
  'as'   => 'userView'
]);

Route::get('news/{id}', [
  'uses' => 'ReportController@reportView',
  'as'   => 'userView'
]);
Route::get('profile/{id}', [
  'uses' => 'UserController@viewProfile',
  'as'   => 'userView'
]);
Route::get('newpost', [
  'uses' => 'UserController@postReport',
  'as'   => 'userView'
]);
Route::post('uploadReport', [
  'uses' => 'ReportController@uploadReport',
  'as'   => 'userView'
]);
Route::get('exit',[
  'uses' => 'UserController@exit',
  'as'   => 'userView'
]);
Route::post('userAuth',[
  'uses' => 'UserController@logIn',
  'as'   => 'userView'
]);
Route::get('log',[
  'uses' => 'UserController@viewLogin',
  'as'   => 'userView'
]);
Route::post('signIn',[
  'uses' => 'UserController@signIn',
  'as'   => 'userView'
]);

Route::get('reg',[
  'uses' => 'UserController@viewSignIn',
  'as'   => 'userView'
]);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
