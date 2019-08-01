<?php

namespace App\Http\Controllers;

use App\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;


class ProjectController extends Controller
{
	public function showProjectList () {
		// プロジェクトを取得
		$project = Project::all();
		$percent_complete = 100;
		$total_amount = 10000000;
		$total_supporter = 100;
		$end_day = 1210;

		//view側へ値を渡す処理
		return view('project/project_list',
		[
			'projects' => $project,
			'percent_complete' => $percent_complete,
			'total_amount' => $total_amount,
			'total_supporter' => $total_supporter,
			'percent_complete' => $percent_complete,
			'end_day' => $end_day,
		]);
	}
}
