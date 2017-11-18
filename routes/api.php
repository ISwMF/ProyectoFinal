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
Route::apiResource('user', 'Admin\UserController');
Route::apiResource('comment', 'Admin\CommentController');
Route::apiResource('report', 'Admin\ReportController');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
