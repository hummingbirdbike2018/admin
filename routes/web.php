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

Route::group(['middleware' => 'auth'], function() {
	//ログイン
	Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');
	Route::post('login', 'Auth\LoginController@login')->name('login');
	//登録
	Route::get('register', 'Auth\RegisterController@showRegisterForm')->name('register');
	Route::post('register', 'Auth\RegisterController@register')->name('register');
	//パスワードリセット
	Route::get('password/rest', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
	//ログアウト
	Route::post('logout', 'Auth\LoginController@logout')->name('logout');
	Route::get('home', 'HomeController@index')->name('home');
	//会員管理
	Route::get('member/management', 'UserController@showMemberList')->name('member.list');
	Route::get('member/edit_status/{id}', 'UserController@showEditForm')->name('member.show');
	Route::post('member/edit_status/{id}/edit', 'UserController@edit')->name('member.edit');
	Route::get('member/view_support/{id}', 'UserController@showSupportList')->name('member.support');
	//起案者管理
	Route::get('planner/management', 'DrafterController@showPlannerList')->name('planner.list');
	Route::post('planner/management', 'DrafterController@edit')->name('planner.edit');
	//プロジェクト管理
	Route::get('project/management', 'ProjectController@showProjectList')->name('project.list');
	Route::post('project/management', 'ProjectController@edit')->name('project.edit');
	Route::post('project/management', 'ProjectController@delete')->name('project.delete');
	//プロジェクト作成
	Route::get('project/create', 'ProjectController@showRegisterForm')->name('project.create');
	Route::post('project/create', 'ProjectController@create')->name('project.create');
});

Auth::routes();
