<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Support extends Model
{

	const NOT_PAY = 0; //決済未完了
	const PAID = 1;    //決済完了

	public function rewards()
	{
		return $this->belongsTo('App\Reward','id');//rewardsテーブルとのリレーション
	}

	public function projects()
	{
		return $this->belongsTo('App\Project','id'); //projectsテーブルとのリレーション
	}


	protected $fillable = [
		 'reward_id', 'user_id', 'pj_id','comment','settlement'
	 ];

}
