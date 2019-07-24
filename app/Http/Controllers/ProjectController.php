<?php

namespace App\Http\Controllers;

use App\Project;
use App\Reward;
use App\Support;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class ProjectController extends Controller
{
	public function index (int $id) {
		// プロジェクトを取得
		$project = Project::find($id);
		// プロジェクトIDに紐づくリワードテーブルを取得
		$rewards = $project->rewards;

		$total_amount   = 0;			// 総支援額
		$supporter_list = array();		// Rewardごとの支援者数を格納する配列
		$stock_list     = array();		// Rewardごとの残り個数を格納する配列

		for($i = 0; $i < $rewards->count(); $i++)
		{
			// TODO：プロジェクトIDに紐づくサポートテーブルを取得するようにする
			$supporter_list[] = Support::where('reward_id', $id++)->get()->count();
			$total_amount += $rewards[$i]['rw_price'] * $supporter_list[$i];
			$stock_list[] = $rewards[$i]['rw_quantity'] - $supporter_list[$i];
		}

		// プロジェクトの開始日
		$start_day = new Carbon($project->created_at);
		// プロジェクトの終了日
		$end_day = new Carbon($project->created_at);
		$end_day->addDay($project->period);
		$end_day_str = date_format($end_day , 'Y年m月d日');
		$end_time = $end_day_str.'23:59';									// 終了までの日数
		$now_datetime = Carbon::now();
		$period = $end_day->diffInDays($now_datetime);						// 残り日数
		$target_amount = $project->target_amount; 							// 目標金
		$percent_complete = floor($total_amount / $target_amount * 100);	// 達成率

		//view側へ値を渡す処理
		return view('projects/project_description',
		[
			'project' => $project,
			'total_amount' => $total_amount,
			'supporter_list' => $supporter_list,
			'period' => $period,
			'end_time' => $end_time,
			'percent_complete' => $percent_complete,
			'rewards' => $rewards,
			'stock_list' => $stock_list,
		]);
	}
}
