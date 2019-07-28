<?php

namespace App\Http\Controllers;

use App\User;
use App\Support;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{


	public function showMemberList () {

		$user = User::all(); //Userテーブルの内容を全取得

		return view('member.member_list',
		[
			'users' => $user,
		]);
	}


	public function showEditForm (int $id) {

		$selected_user = User::where('id', $id)->get();

		return view('member.edit_status',
		[
			'users' => $selected_user,
		]);
	}


	public function edit (Request $request,$id) {
		//二重送信防止
		$request->session()->regenerateToken();
		//ユーザ情報
		$selected_user = User::where('id', $id)->get();
		//POSTで受けとったデータを配列に格納
		$user_data = [
			'status' => $request->status,
			'dis_reason' => $request->dis_reason,
		];
		// var_dump($request->status);
		// exit;
		//フォームに入力された内容をDBに上書き
		User::find($id)->update($user_data);
		//ステータス変更後会員一覧へリダイレクト
		return redirect(route('member.list'));


		return view('member.edit_status',
		[
			'users' => $selected_user
		]);
	}

	public function showSupportList ($id) {

		$support_list = Support::where('user_id', $id)->get();
		$s = $support_list->rewards()->get();

		var_dump($s);
		exit;
		return view('member.view_support',
		[
			'supports' => $support_list
		]);
	}
}
