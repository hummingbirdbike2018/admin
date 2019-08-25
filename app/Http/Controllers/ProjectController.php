<?php

namespace App\Http\Controllers;

use App\Project;
use App\Support;
use App\Planner;
use App\Reward;
use Carbon\Carbon;
use Illuminate\Http\Request;


class ProjectController extends Controller
{
	public function showProjectList () {
		// リワードID、サポートID
		$id = 1;
		// DBからプロジェクトをすべて取得する
		$projects = Project::all();
		// 各プロジェクトの達成率を格納する配列
		$percent_completes = array();
		// 各プロジェクトの総支援額を格納する配列
		$total_amount_list = array();
		// 各プロジェクトの総支援者数を格納する配列
		$supporter_list = array();
		// 各プロジェクトの残り日数を格納する配列
		$period = array();
		// 各プロジェクトの起案者を格納する配列
		$planners_list = array();
		//終了日を格納する配列
		$end_day_list = array();

		for($i = 0; $i < $projects->count(); $i++)
		{
			//
			$planners = Planner::select()
														->join('projects', 'projects.planner_id', '=', 'planners.id')
														->get();
			$planners_list[] = $planners[$i]['name'];
			// 総支援者数を設定する
			$supporter_list[] = Support::where('reward_id', $id)->count();
			// 総支援額を設定する
			$total_amount_list[] = Reward::where('pj_id', $id)->sum('rw_price');;
			// 達成率を設定する
			$percent_completes[] = floor($total_amount_list[$i] / $projects[$i]->target_amount * 100);
			// 残り日数を設定する
			$end_day = new Carbon($projects[$i]->created_at);
			$end_day->addDay($projects[$i]->period);
			$end_day_list[] = $end_day;
			$now_datetime = Carbon::now();
			$period[] = $end_day->diffInDays($now_datetime);
			$id++;
		}
		// var_dump($planners_list);
		// exit;
		//view側へ値を渡す処理
		return view('project/project_list',
		[
			'projects' => $projects,
			'planners_list' => $planners_list,
			'supporter_list' => $supporter_list,
			'total_amount_list' => $total_amount_list,
			'percent_completes' => $percent_completes,
			'period' => $period,
			'end_day' => $end_day_list,

		]);
	}


	public function showEditForm ($id) {

		$project = project::find($id);

		return view('project/project_edit',
		[
			'projects' => $project,
		]);
	}
}
