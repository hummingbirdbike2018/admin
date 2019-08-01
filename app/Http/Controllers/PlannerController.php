<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Planner;

class PlannerController extends Controller
{
	public function showPlannerList () {

		$planner = Planner::all(); //Plannerテーブルの内容を全取得

		return view('planner.planner_list',
		[
			'planners' => $planner,
		]);
	}


	public function showEditForm (int $id) {

		$selected_planner = Planner::find($id);

		return view('planner.planner_edit',
		[
			'planner' => $selected_planner,
		]);
	}


	public function edit (Request $request,$id) {
		//二重送信防止
		$request->session()->regenerateToken();
		//ユーザ情報
		$selected_planner = Planner::find($id);
		//POSTで受けとったデータを配列に格納
		$planner_data = [
			'name' => $request->name,
			'name_kana' => $request->name_kana,
			'post_code' => $request->post_code,
			'address' => $request->address,
			'building' => $request->building,
			'tel' => $request->tel,
			'intro' => $request->intro,
			'status' => $request->status,
			'dis_reason' => $request->dis_reason,
		];

		//フォームに入力された内容をDBに上書き
		Planner::find($id)->update($planner_data);
		//ステータス変更後会員一覧へリダイレクト
		return redirect(route('planner.list'));

		return view('planner.planner_edit',
		[
			'planner' => $selected_planner
		]);
	}
}
