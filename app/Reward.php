<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{

	protected $primaryKey = "id";

	public function projects()
	{
		return $this->belongsTo('App\Project', 'id');//projectテーブルとのリレーション
	}

	public function supports()
	{
		return $this->hasMany('App\Support', 'reward_id');//supportテーブルとのリレーション
	}

	protected $fillable = [
		 'id', 'rw_title',
		 'rw_body', 'rw_image', 'rw_quantity', 'rw_price', 'rw_season',
	 ];
}
