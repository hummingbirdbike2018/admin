<?php

namespace App\Http\Controllers;

use App\User;
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

		$selected_user = User::find($id);

		return view('member.member_edit',
		[
			'user' => $selected_user,
		]);
	}


	public function edit (Request $request,$id) {
		//二重送信防止
		$request->session()->regenerateToken();
		//ユーザ情報
		$selected_user = User::find($id);
		//POSTで受けとったデータを配列に格納
		$user_data = [
			'display' => $request->display,
			'name' => $request->name,
			'name_kana' => $request->name_kana,
			'post_code' => $request->post_code,
			'address' => $request->address,
			'building' => $request->building,
			'tel' => $request->tel,
			'status' => $request->status,
			'dis_reason' => $request->dis_reason,
		];

		//フォームに入力された内容をDBに上書き
		User::find($id)->update($user_data);
		//ステータス変更後会員一覧へリダイレクト
		return redirect(route('member.list'));

		return view('member.member_edit',
		[
			'user' => $selected_user
		]);
	}
}
