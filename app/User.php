<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{

	public function supports()
	{
		return $this->hasMany('App\Support', 'user_id');//supportsテーブルとのリレーション
	}


	protected $fillable = [
		'id', 'display', 'user_image', 'name', 'name_kana', 'tel', 'post_code', 'address', 'building',
		'email', 'password', 'status', 'dis_reason', 'remember_token',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'reuser_token',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
	];
}
