<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;

class AdminController extends Controller
{
	public function showAdminList () {

		$admin = Admin::all(); //adminテーブルの内容を全取得

		return view('admin.admin_list',
		[
			'admins' => $admin,
		]);
	}


	public function showEditForm (int $id) {

		$selected_admin = Admin::find($id);

		return view('admin.admin_edit',
		[
			'admin' => $selected_admin,
		]);
	}


	public function edit (Request $request,$id) {
		//二重送信防止
		$request->session()->regenerateToken();
		//ユーザ情報
		$selected_admin = Admin::find($id);
		//POSTで受けとったデータを配列に格納
		$admin_data = [
			'name' => $request->name,
			'status' => $request->status,
			'dis_reason' => $request->dis_reason,

		];

		//フォームに入力された内容をDBに上書き
		Admin::find($id)->update($admin_data);
		//ステータス変更後会員一覧へリダイレクト
		return redirect(route('admin.list'));

		return view('admin.admin_edit',
		[
			'admins' => $selected_admin
		]);
	}
}
