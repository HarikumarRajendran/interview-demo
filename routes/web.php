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

Route::get('/', ['as' => 'get-login','uses' => 'HomeController@getIndex']);

Route::post('/login', ['as' => 'post-login','uses' => 'HomeController@postLogin']);

Route::get('/admin', ['as' => 'get-admin','uses' => 'HomeController@getAdmin']);

Route::get('/user', ['as' => 'get-user','uses' => 'HomeController@getUser']);

Route::post('/add-user', ['as' => 'add-user','uses' => 'HomeController@postAddUser']);

Route::post('/update-user', ['as' => 'update-user','uses' => 'HomeController@postUpdateUser']);

Route::post('/admin/user-status', ['as' => 'admin-user-status','uses' => 'HomeController@postAdminUserStatus']);

Route::get('/admin/logout', ['as' => 'admin-logout','uses' => 'HomeController@getAdminLogout']);

Route::get('/user/logout', ['as' => 'user-logout','uses' => 'HomeController@getUserLogout']);
