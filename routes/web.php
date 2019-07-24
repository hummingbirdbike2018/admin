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
	Route::get('member/management', 'Auth\MemberController@showMemberList')->name('member.list');
	Route::post('member/management', 'Auth\MemberController@edit')->name('member.edit');
	//起案者管理
	Route::get('drafter/management', 'Auth\DrafterController@showDrafterList')->name('drafter.list');
	Route::post('drafter/management', 'Auth\DrafterController@edit')->name('drafter.edit');
	//プロジェクト管理
	Route::get('project/management', 'Auth\ProjectController@showProjectList')->name('project.list');
	Route::post('project/management', 'Auth\ProjectController@edit')->name('project.edit');
	Route::post('project/management', 'Auth\ProjectController@delete')->name('project.delete');
	//プロジェクト作成
	Route::get('project/create', 'Auth\ProjectController@showRegisterForm')->name('project.create');
	Route::post('project/create', 'Auth\ProjectController@create')->name('project.create');
});

Auth::routes();
