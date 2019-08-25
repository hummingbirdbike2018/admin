<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Support extends Model
{


	public function rewards()
	{
		return $this->belongsTo('App\Reward', 'id');//rewardsテーブルとのリレーション
	}

	public function projects()
	{
		return $this->belongsTo('App\Project', 'id'); //projectsテーブルとのリレーション
	}

	public function users()
	{
		return $this->belongsTo('App\User', 'id'); //usersテーブルとのリレーション
	}


	protected $fillable = [
		 'id', 'reward_id', 'user_id', 'pj_id','comment','settlement'
	 ];

}
