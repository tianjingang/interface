<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::any('/','UserController@login');
Route::any('loginpro','UserController@loginpro');
Route::any('show','UserController@show');
Route::any('del','UserController@del');
Route::any('hui','UserController@hui');
Route::any('loginout','UserController@loginout');
Route::any('login','UserController@login');
Route::any('showlist','UserController@showlist');
Route::any('huifu','UserController@huifu');
Route::any('log','UserController@log');


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});
