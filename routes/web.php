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
	//管理者管理
	Route::get('admin/management', 'AdminController@showAdminList')->name('admin.list');
	Route::get('admin/edit_status/{id}', 'AdminController@showEditForm')->name('admin.show');
	Route::post('admin/edit_status/{id}/edit', 'AdminController@edit')->name('admin.edit');
	//会員管理
	Route::get('member/management', 'UserController@showMemberList')->name('member.list');
	Route::get('member/edit_status/{id}', 'UserController@showEditForm')->name('member.show');
	Route::post('member/edit_status/{id}/edit', 'UserController@edit')->name('member.edit');
	//起案者管理
	Route::get('planner/management', 'PlannerController@showPlannerList')->name('planner.list');
	Route::get('planner/edit_status/{id}', 'PlannerController@showEditForm')->name('planner.show');
	Route::post('planner/edit_status/{id}/edit', 'PlannerController@edit')->name('planner.edit');
	//プロジェクト管理
	Route::get('project/management', 'ProjectController@showProjectList')->name('project.list');
	Route::get('project/edit_status/{id}', 'ProjectController@showEditForm')->name('project.show.edit');
	Route::post('project/edit_status/{id}/edit', 'ProjectController@edit')->name('project.edit');
	Route::post('project/edit_status/{id}/delete', 'ProjectController@delete')->name('project.delete');
	Route::get('project/create', 'ProjectController@showCreateForm')->name('project.show.create');
	Route::get('project/create/confirm', 'ProjectController@showCreateConfirm')->name('project.create.confirm');
	Route::post('project/create/post', 'ProjectController@create')->name('project.create');

});

Auth::routes();
